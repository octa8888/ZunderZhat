var chatLen=0;
function getData() {
    $.ajax({
        url: '/ZunderZhat/controller/global_chat_controller.php',
        method: 'POST',
        data: {
            'get_data': 'get_data',
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

$(document).ready(function () {
    getData();
    setInterval(function(){
        getData();
    },3000);
});