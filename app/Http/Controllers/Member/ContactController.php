<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ContactType;
use App\Models\Member\Contact;

class ContactController extends Controller
{
    private $memberID;
    private $contact;
    public function __construct()
    {
        $this->middleware(
            function($request, $next) {
                $memberID = Auth::user()->id;
                $this->contact = Contact::with([
                        'type' => function($query) {
                            $query->withCount('contacts', 'memberContacts');
                        },
                    ])->whereHas(
                        'member', function($query) use($memberID) {
                            $query->where('id', $memberID);
                        }
                    )
                    ->whereFirst($request->get('contact'));
                if(is_null($this->contact['members'])) {
                    return abort(403);
                }
                $this->memberID = $memberID;
                return $next($request);
            }
        )->except('store');
    }

    public function store( Request $request ) {
        DB::beginTransaction();
        $typeID = ContactType::findOrCreate(['name' => $request->type]);
        Contact::create([
            "member_id" => Auth::user()->member()->id,
            "name" => $request->name,
            "type_id" => $typeID,
            "link" => $request->link,
            "contact" => $request->contact,
            "order_number" => $request->order_number,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function update( Request $request, $id ) {
        $contact = $this->contact;
        $type = $contact->type;
        DB::beginTransaction();
        if($type->name != $request->type) {
            if(
                !$type->contacts_count &&
                $type->memberContacts_count == 1
            ) {
                $existType = ContactType::firstWhere('name', $request->name);
                if(is_null($existType)) {
                    $type->update(['name' => $request->name]);
                } else {
                    $type->delete();
                    $type = $existType;
                }
            } else {
                $type = ContactType::findOrCreate(['name' => $request->type]);
            }
        }
        $contact->update([
            "name" => $request->name,
            "type_id" => $type->id,
            "link" => $request->link,
            "contact" => $request->contact,
            "order_number" => $request->order_number,
        ]);
        DB::commit();
        // return response
        // ...
    }

    public function destroy( $id ) {
        DB::beginTransaction();
        $contact = $this->contact;
        $type = $contact->type;
        if(
            !$type->contacts_count &&
            $type->memberContacts_count == 1
        ) {
            $type->delete();
        }
        $contact->delete();
        DB::commit();
        // return response
        // ...
    }
}
