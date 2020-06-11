function getData(){
    $.ajax({
        url:'/ZunderZhat/controller/friend_controller.php',
        method:'POST',
        data:{
            'get_req':'get_req',
        },
        success:function(res){
            var data = JSON.parse(res);
            var html="";
            for (let i = 0; i < data.length; i++) {
                html += `
                <div class="req">
                    <h2>
                        ${data[i].username}
                    </h2>
                    <div style="display:flex">
                        <form action="controller/friend_controller.php" method="post" style="margin-right:1vw">
                            <input type="hidden" name="friend_id" value="${data[i].from_id}">
                            <input type="hidden" name="req_id" value="${data[i].id}">
                            <button type="submit" class="btn btn-primary" name="accept">Accept</button>
                        </form>
                        <form action="controller/friend_controller.php" method="post">
                            <input type="hidden" name="friend_id" value="${data[i].from_id}">
                            <input type="hidden" name="req_id" value="${data[i].id}">
                            <button type="submit" class="btn btn-danger" name="reject">Reject</button>
                        </form>
                    </div>
                </div>
                `;
            }
            $('.friend-part').html(html);
        }
    });
}

$(document).ready(function(){
    getData();
});