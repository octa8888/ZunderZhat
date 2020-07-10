function getData() {
    $.ajax({
        url: '/ZunderZhat/controller/private_chat_controller.php',
        method: 'POST',
        data: {
            'get_data': 'get_data',
            'csrf_token':csrf_token,
        },
        success: function (res) {
            var data = JSON.parse(res);
            var html = "";
            for (let i = 0; i < data.length; i++) {
                var userId = data[i].user1_id;
                var username = data[i].user1_username;
                if (userId == currUser) {
                    userId = data[i].user2_id;
                    username = data[i].user2_username;
                }
                html += `
                    <div class="chat-content" style="cursor:pointer; width:100% !important;" onClick="openPrivateChat(${data[i].id})">
                        <div class="user">
                            ${username}
                        </div>
                    </div>
                `
            }
            if(data.length==0){
                html=`
                    <div style="display:flex; justify-content:center">
                        <h3>There is no friend</h3>
                    </div>
                `;
            }
            $('.chat-part').html(html);
        }
    });
}

function openPrivateChat(msgId) {
    window.location.href="private_chat?msg_id="+msgId;
}


$(document).ready(function () {
    getData();
});