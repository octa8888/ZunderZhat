function getData() {
    $.ajax({
        url: '/ZunderZhat/controller/private_chat_controller.php',
        method: 'POST',
        data: {
            'get_data': 'get_data',
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
                    <div class="chat-content" style="cursor:pointer" onClick="openPrivateChat(${data[i].id})">
                        <div class="user">
                            ${username}
                        </div>
                    </div>
                `
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