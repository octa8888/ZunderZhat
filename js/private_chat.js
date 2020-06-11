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
                var style = "";
                if (data[i].user_id == currUser) {
                    style = `style="border-color:green;"`;
                }
                html += `
                <div class="chat-content" ${style}>
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


$(document).ready(function () {
    getData();
    setInterval(function(){
        getData();
    },3000);
});