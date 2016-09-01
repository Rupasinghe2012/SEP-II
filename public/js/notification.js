var notifications = [];
var red = '#FF7B91';
var green = '#80FF8F';
var blue = '#7BAFD4';

/* format notifications */
function generateNotification(id, diff, message, color) {

    var section = '<div class="row col-md-12 notification" id="notification_'+ id +'">' +
        '<li class="alert-danger">' +
    '<a href="#" class="col-md-12">' +
        '<i class="fa fa-users text-red "></i><small>'+message+'</small>'+
        '<small class="text-muted pull-right"><i class="fa fa-clock-o"></i>'+diff +'</small>'+
    '</a>'+
    '</li>'+
            '<hr>'+
            '</div>';
    $('#notification-bar').prepend(section);
}

function isAlreadyDisplayed(id) {
    return notifications.indexOf(id);
}

/* handles the incoming notifications and the time
 *  use cases to match type with the database
 *  change the last parameter of the method call to change the color
 * */
function dataHandler(type, msg){
    if(msg != 0) {
        $(msg).each(function(row,data) {
            if(isAlreadyDisplayed(data['id']) == -1) {
                notifications.push(data['id']);
                switch (data['type']) {


                    case 'self-profile_update'://iruka
                        generateNotification(data['id'], data['diff'], 'You have updated your Profile', green);
                        break;
                    case 'self-proPic_change'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Changed Your Profile Picture', green);
                        break;
                    case 'self-password_change'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Changed Your Password', green);
                        break;
                    case 'self-Social'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Changed Your Social Profile Links', green);
                        break;
                    case 'add_album'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Created a new Album.', green);
                        break;
                    case 'edit_album'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Updated the Album Details.', green);
                        break;
                    case 'add_image'://iruka
                        generateNotification(data['id'], data['diff'], 'You have added Photos to the Album.', green);
                        break;
                    case 'delete_album'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Deleted a whole Album.', green);
                        break;
                    case 'delete_image'://iruka
                        generateNotification(data['id'], data['diff'], 'You have Deleted a Photo form a Album.', green);
                        break;
                    //Admin
                    case 'add_temp'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Added a new Template.', green);
                        break;
                    case 'update_temp'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Updated Template details.', green);
                        break;
                    case 'delete_temp'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Deleted a Template.', green);
                        break;
                    case 'add_slide'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have added a Slideshow image.', green);
                        break;
                    case 'remove_slide'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Removed a image from the SlideShow.', green);
                        break;
                    case 'promote_mod'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Promoted a user to Moderator.', green);
                        break;
                    case 'promote_admin'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Pormoted a user to Admin.', green);
                        break;
                    case 'demote'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Demoted a user.', green);
                        break;
                    case 'kicked'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Kicked Out a user', green);
                        break;
                    case 'ignore_mail'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have ignored a mail', green);
                        break;
                    case 'reply_mail'://tharidu
                        generateNotification(data['id'], data['diff'], 'You have Replyed a mail', green);
                        break;
                    default:
                        console.log(type + ':' + msg);
                }
            } else {
                var id = 'time_' + data['id'];
                $('#'+id).html(data['diff']);
            }
        });
    }
}

/* push message as read to the server */
function markAsRead(id) {
    $.ajax({
        type: 'PATCH',
        url: '/notifications',
        data: {
            read : true
        },
        dataType: 'json',
        async: true,

        error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log('error' + textStatus + ' (' + errorThrown + ')');
        }
    });
}

/* fetch notification from the server */
function waitForNotifications(){
    $.ajax({
        type: 'GET',
        url: '/notifications',

        async: true,
        cache: false,
        timeout:50000,

        success: function(data){
            dataHandler('new', data);
            setTimeout(
                waitForNotifications,
                5000
            );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            dataHandler('error', textStatus + ' (' + errorThrown + ')');
            setTimeout(
                waitForNotifications,
                15000);
        }
    });
};


/* fetch notification from the server */
function waitForNotificationsC(){
    $.ajax({
        type: 'GET',
        url: '/notificationsC',

        async: true,
        cache: false,
        timeout:50000,

        success: function(data){
            dataHandler('new', data);

            $("#notificationBell").html(data);

            setTimeout(
                waitForNotificationsC,
                5000
            );
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            dataHandler('error', textStatus + ' (' + errorThrown + ')');
            setTimeout(
                waitForNotificationsC,
                15000);
        }
    });
};
/* mark notification as read */
$(document).on('click','.dropdown-toggle', function(){

    $.ajax({
        type: 'PATCH',
        url: '/notifications',
        data: {
            read : true
        },
        dataType: 'json',
        async: true,

        success: function(data){
            dataHandler('new', data);


            setTimeout(
                waitForNotificationsC,
                5000
            );
        },


        error: function(XMLHttpRequest, textStatus, errorThrown){
            console.log('error' + textStatus + ' (' + errorThrown + ')');
        }
    });

});


/* Start the initial request */
$(document).ready(function() {
    //if($('#notification').length == 0) {
    //    var section = '<div class="row col-md-12 notification" id="all-caught-up">'+
    //        '<div class="card" style="padding: 10px;display: none;background-color: white">'+
    //        '<img src="/images/ic_notifications.png" style="display:block;margin:auto">'+
    //        '<p style="text-align: center"><b >All caught up!</b></p>'+
    //        '</div>'+
    //        '</div>';
    //   // $('#notification-bar').append(section).find('div.card').fadeIn('slow');
    //}

    waitForNotifications();
    waitForNotificationsC();
});/**
 * Created by user on 5/28/2016.
 */
