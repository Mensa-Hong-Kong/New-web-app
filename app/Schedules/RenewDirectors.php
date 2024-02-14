<?php
    use App\Models\Member\Appointment;

    class RenewDirectors {
        public function __invoke() {
            $now = now();
            $roles = Role::whereHas(
                    "teams", function( $query ) {
                        $query->where( "id", 1 );
                    }
                )->findOrFail(1);
            foreach( $roles as $role ) {
                $appointment = Appointment::with( "members.user" )
                    ->where( "organize_id", 1 )
                    ->where( "team_id", 1 )
                    ->where( "role_id", $role )
                    ->whereNotNull( "from" )
                    ->whereNotNull( "to" )
                    ->whereBetweenColumn( $now, [ "from", "to" ] )
                    ->get();
                $sync = [];
                foreach( $appointment[ "members" ] as $member ) {
                    $sync[] = $member[ "user" ][ "id" ];
                }
                if( count( $sync ) > 0 ) {
                    $role->users()->sync( $sync );
                } else {
                    $role->users()->detach();
                }
            }
            return true;
        }
    }
