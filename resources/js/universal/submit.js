token = document.querySelector("meta[name='csrf-token']").getAttribute("content");
submitForm = function( formData, action, successCallback = "", failCallback = "" ) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if ( xmlHttp.readyState == 4 ) {
            // console.log("ready");
            // console.log(this.getResponseHeader('content-type'));
            if( xmlHttp.status == 200 ) {
                var msgs = JSON.parse(this.responseText);
                if( Array.isArray( msgs ) ) {
                    alertMessage = "";
                    msgs.forEach(
                        function(msgs, index, array){
                            // console.log(errorMsg.input);
                            // console.log(errorMsg.message);
                            if( failCallback == "" ) {
                                if( input = document.getElementById( msgs.type ) ) {
                                    if( msgs.type != "msg" ) {
                                        showError( input, msgs.message );
                                    } else {
                                        alertMessage += msgs.message + "\r\n";
                                    }
                                }
                            } else {
                                failCallback( msgs );
                            }
                        }
                    );
                    if( alertMessage != "" ) {
                        alert( alertMessage );
                    }
                } else {
                    // console.log( msgs.url );
                    if( msgs.type == "success" ) {
                        if( successCallback == "" ) {
                            if( msgs.url ) {
                                window.location = msgs.url;
                            }
                            if( msgs.message ) {
                                alert( msgs.message );
                            }
                        } else {
                            successCallback( msgs );
                        }
                    } else {
                        if( failCallback == "" ) {
                            alert( msgs.message );
                        } else {
                            failCallback( msgs );
                        }
                    }
                }
                // console.log(errorMsgs);
            } else {
                switch( xmlHttp.status ) {
                    case 503:
                        message = "系統維護中，請留意公告或稍後再嘗試。如異常持續而沒有公告，請跟客服人員聯絡。";
                        break;
                    case 500:
                        message = "系統錯誤，請跟客服人員聯絡";
                        break;
                    case 419:
                        message = "跨站請求偽造警告：如長時間停留本頁，請刷新頁面，否則，請注意網址是否有異常。";
                        break;
                    case 403:
                        message = "抱歉，您的權限不足";
                        break;
                    case 401:
                        message = "抱歉，請先登入，再嘗試";
                        break;
                }
                alert( message );
            }
        }
    }
    xmlHttp.open( "POST", action, true );
    xmlHttp.setRequestHeader( "X-CSRF-TOKEN", token );
    xmlHttp.send( formData );
}
