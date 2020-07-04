var chatLen=0;
function getData() {
    $.ajax({
        url: '/ZunderZhat/controller/private_chat_controller.php',
        method: 'POST',
        data: {
            'get_messages': 'get_messages',
            'msg_id': msgId,
        },
        success: function (res) {
            var data = JSON.parse(res);
            var html = "";
            for (let i = 0; i < data.length; i++) {
                var style="chat-content";
                if(data[i].user_id==currUser){
                    style=`chat-content-2"`;
                }
                html += `
                <div class="${style}">
                    <div class="user">
                        ${data[i].username}
                    </div>
                    <div class="content">
                        ${data[i].message}
                    </div>
                </div>
                `;
            }
            $('.chat-part').html(html);
            if(chatLen==0){
                chatLen=data.length;
                $('.chat-part').scrollTop($('.chat-part')[0].scrollHeight);
            }
            if(chatLen<data.length){
                $('.chat-part').scrollTop($('.chat-part')[0].scrollHeight);
                chatLen=data.length;  
            }
        }
    });
}

function uploadFile(e){
    e.preventDefault();
    var file=e.dataTransfer.files[0];
    if(file == undefined){
        return;
    }
    var formData=new FormData();
    formData.append('file',file);
    formData.append('file_upload','file_upload');
    $.ajax({
        url: '/ZunderZhat/controller/private_chat_controller.php',
        method: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(res){
            alert(res);
        },
    });
}

$(document).ready(function () {
    getData();
    setInterval(function(){
        getData();
    },3000);
});