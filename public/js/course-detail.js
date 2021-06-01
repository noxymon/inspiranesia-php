$(function () {

    $("#btnJoinCourse").click(function () {
        startLoading();

        if(loginResponse == null){
            $(location).attr('href', "/login?prevUrl=/course/"+courseResult.id);
        }

        $.get({
            url: "/api/hash/" + loginResponse.id + "/generate",
        }).done(function (data) {
            $.post({
                url: "/api/course/" + courseResult.id + "/join",
                data: JSON.stringify({memberId: loginResponse.id, hash: data.hash}),
                contentType: 'application/json; charset=utf-8'
            }).fail(function () {
                $("#errorModal").modal('show', {keyboard: false});
                $("#btnJoinCourse").show();
            }).done(function () {
                $("#btnAlreadyJoined").show();
            }).always(function () {
                endLoading();
                window.location.reload(true);
            })
        });


    });

    $("#btnStartCourse").click(function () {

    })

    function startLoading() {
        $("#btnJoinCourse").hide();
        $("#btnJoinCourseLoading").show();
    }

    function endLoading() {
        $("#btnJoinCourseLoading").hide();
    }
})
