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
                var style="";
                if(data[i].user_id==currUser){
                    style=`style="border-color:green;"`;
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

        }
    });
}

$(document).ready(function () {
    getData();
});