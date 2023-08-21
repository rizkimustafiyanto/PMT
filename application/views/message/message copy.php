<?php
if (!empty($profiles)) {
    foreach ($profiles as $key) {
        $profile_foto = $key->gender_id;
        $profile_name = $key->member_name;
        $profile_divisi = $key->division_name;
        $profile_department = $key->department_name;
        $profile_email = $key->email;
    }
} else {
    $profile_foto = '-';
    $profile_name = '-';
    $profile_divisi = '-';
    $profile_department = '-';
    $profile_email = '-';
}

?>
<style>
    .responsive {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="content-wrapper" style="min-height: 1604.71px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Messages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($profile_foto == 'GR-001') ? '5' : '3' ?>.png" alt="User Image" class="rounded-circle" style="width: 90px; height: 90px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body box-profile mx-auto" style="margin-top: 10px;"> <!-- Menambahkan kelas "mx-auto" -->
                                    <div class="text-center">
                                        <h3 class="profile-username text-center"><?= $profile_name ?></h3>
                                        <p class="text-muted text-center"><?= $profile_divisi ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4" id="column_messages">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Messages</h3>
                        </div>

                        <div class="card-body text-center">
                            <ul class="list-unstyled">
                                <?php if (!empty($ColumnMessages)) {
                                    foreach ($ColumnMessages as $row) {
                                ?>
                                        <li>
                                            <a class="btn btn-secondary btn-select-sender" type="btn btn-secondary" data-sender="<?= $row->sender_id ?>">
                                                <div class="row text-center">
                                                    <div class="col-md-4"><img src="<?= base_url(); ?>assets/dist/img/avatar<?= ($profile_foto == 'GR-001') ? '5' : '3' ?>.png" class="mr-3" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%;"></div>
                                                    <div class="col-md-8 text-left">
                                                        <div class="media-body">
                                                            <div class="mt-0 mb-1 responsive text-truncate" style="max-width: 100%;"><?= $row->sender_name ?></div>
                                                            <div><?= $row->created_at ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php }
                                } else { ?>
                                    <p>No messages yet.</p>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8" id="isi_messages">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Message Details</h3>
                        </div>

                        <div class="card-body">
                            <div class="direct-chat-messages" id="message-container" style="height: 205px; overflow-y: auto;">
                                <!-- Show 'Pesan Kosong' if no sender is selected -->
                                <p id="empty-message" class="text-center">Pesan Kosong</p>
                            </div>
                            <div id="empty-message2" style="height: 205px;">
                                <p class="text-center">Pesan Kosong</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form id="send-message-form">
                                <input type="hidden" id="current-member-id" value="<?= $this->session->userdata('member_id') ?>">
                                <div class="input-group">
                                    <input type="text" id="message-input" class="form-control" placeholder="Type your message...">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    $(document).ready(function() {
        var messageContainer = $("#message-container");
        var emptyMessage = $("#empty-message");
        var emptyMessage2 = $("#empty-message2");

        // Hide the message container and show 'Pesan Kosong' message initially
        messageContainer.hide();
        emptyMessage.show();
        emptyMessage2.show();

        // Attach click event to sender selection buttons
        $(".btn-select-sender").click(function() {
            var senderId = $(this).data("sender");
            // Replace 'Pesan Kosong' with selected sender messages
            emptyMessage.hide();
            emptyMessage2.hide();
            messageContainer.empty();
            messageContainer.show();

            // Take pesan
            function messageRT() {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url(); ?>get_messages',
                    data: {
                        senderId: senderId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.messages.length > 0) {
                            $.each(response.messages, function(index, message) {
                                var messageClass = (message.sender_id == response.current_member_id) ? 'right' : '';
                                messageContainer.append(
                                    '<div class="direct-chat-msg ' + messageClass + '">' +
                                    '<div class="direct-chat-infos clearfix">' +
                                    '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + message.sender_name + '</span>' +
                                    '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + message.created_at + '</span>' +
                                    '</div>' +
                                    '<img class="direct-chat-img" src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="message user image">' +
                                    '<div class="direct-chat-text">' + message.message + '</div>' +
                                    '</div>'
                                );
                            });

                            messageContainer.scrollTop(messageContainer[0].scrollHeight);
                        } else {
                            messageContainer.hide();
                            emptyMessage.show();
                        }
                    },
                    error: function(error) {
                        console.log("Error fetching messages:", error);
                    }
                });
            }

            // Kirim pesan
            $("#send-message-form").submit(function(event) {
                event.preventDefault();
                var currentMemberId = $("#current-member-id").val();
                var message = $("#message-input").val();

                $.ajax({
                    type: 'POST',
                    url: '<?= base_url(); ?>insert_message',
                    data: {
                        senderId: senderId,
                        currentMemberId: currentMemberId,
                        message: message
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var messageClass = (response.message.sender_id == response.current_member_id) ? 'right' : '';
                            messageContainer.append(
                                '<div class="direct-chat-msg ' + messageClass + '">' +
                                '<div class="direct-chat-infos clearfix">' +
                                '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + response.message.sender_name + '</span>' +
                                '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + response.message.created_at + '</span>' +
                                '</div>' +
                                '<img class="direct-chat-img" src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="message user image">' +
                                '<div class="direct-chat-text">' + response.message.message + '</div>' +
                                '</div>'
                            );

                            $("#message-input").val('');

                            messageContainer.scrollTop(messageContainer[0].scrollHeight);
                        } else {
                            console.log("Error inserting message:" + senderId, response.error);
                        }
                    },
                    error: function(error) {
                        console.log("Error inserting message:" + senderId, error);
                    }
                });
            });

            // function fetchMessages(senderId) {
            //     $.ajax({
            //         type: 'GET',
            //         url: 'get_messages/' + senderId,
            //         dataType: 'json',
            //         success: function(response) {
            //             if (response && response.messages.length > 0) {
            //                 $.each(response.messages, function(index, message) {
            //                     var messageClass = (message.sender_id == response.current_member_id) ? 'right' : '';
            //                     messageContainer.append(
            //                         '<div class="direct-chat-msg ' + messageClass + '">' +
            //                         '<div class="direct-chat-infos clearfix">' +
            //                         '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + message.sender_name + '</span>' +
            //                         '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + message.created_at + '</span>' +
            //                         '</div>' +
            //                         '<img class="direct-chat-img" src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" alt="message user image">' +
            //                         '<div class="direct-chat-text">' + message.message + '</div>' +
            //                         '</div>'
            //                     );
            //                 });

            //                 messageContainer.scrollTop(messageContainer[0].scrollHeight);
            //             }
            //         },
            //         error: function(error) {
            //             console.log("Error fetching messages:", error);
            //         }
            //     });
            // }

            setInterval(function() {
                messageRT();
                // var activeSender = $(".btn-select-sender.active");
                // if (activeSender.length > 0) {
                //     var senderId = activeSender.data("sender");
                //     fetchMessages(senderId);
                // }
            }, 1000);
        });


    });
</script>