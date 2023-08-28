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

    #select_sender:hover {
        background-color: #f4f4f4;
        cursor: pointer;
        display: flex;
        align-items: center;
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
                                <div class="card-body box-profile mx-auto" style="margin-top: 10px;">
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
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Messages</h3>
                                            <div class="card-tools" style="padding-right: 5px;">
                                                <a style="margin: 0px; cursor: pointer;padding-right: 5px;" data-toggle="modal" data-target="#delete-messages"> <i class="fa fa-trash"></i></a>
                                                <a style="margin: 0px; cursor: pointer;" data-toggle="modal" data-target="#input-new-messages"> <i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div id="messages-container" class="messages-container">
                                                    <!-- Messages will be appended here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8" id="isi_messages">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Message Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="direct-chat-messages" id="message-container">
                            </div>
                            <div class="empty-message-container d-flex align-items-center justify-content-center">
                                <p id="empty-message" class="text-center">Pesan Kosong</p>
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
    <!-- Input Messages -->
    <div class="modal fade" id="input-new-messages">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input New Messages</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>InsertNewMessages" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="message_to">To</label>
                                <select class="form-control select2bs4" id="message_to" name="message_to" data-width=100%>
                                    <?php foreach ($listmember as $row) : ?>
                                        <option value="<?= $row->member_id; ?>"><?= $row->member_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" id="btnSubmit" class="btn btn-primary" value="Save" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Batas Input Messages -->
    <!-- Delete Messages -->
    <div class="modal fade" id="delete-messages">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Messages</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="<?= base_url(); ?>DeleteMessages" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="delete_sender">Massage</label>
                                <select class="form-control select2bs4" id="delete_sender" name="delete_sender" data-width=100%>
                                    <?php foreach ($ColumnMember as $row) : ?>
                                        <option value="<?= $row->sender_id; ?>"><?= $row->sender_name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" class="btn btn-danger" value="Delete" />
                        <input type="reset" class="btn btn-default" value="Reset" />
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Batas Delete Messages -->

</div>

<script>
    $(document).ready(function() {
        var messagesContainer = $("#messages-container");
        var scrollingC = false;

        function columnMessages() {
            $.ajax({
                type: 'GET',
                url: '<?= base_url(); ?>ColumnMessage',
                dataType: 'json',
                success: function(response) {
                    console.log("Received response:", response);
                    if (response === null) {
                        messagesContainer.empty();
                    } else if (response.ColumnMessages !== null && response.ColumnMessages.length > 0) {
                        var previousScrollHeight = messagesContainer[0].scrollHeight;
                        messagesContainer.empty();
                        $.each(response.ColumnMessages, function(index, row) {
                            if (row.sender_id.trim() !== '') {
                                var potoBox = row.gender_id === 'GR-001' ? '5.png' : '3.png';
                                var rowHtml =
                                    '<div class="container mt-2">' +
                                    '<div id="select_sender" data-sender="' + row.sender_id + '" class="col-md-12">' +
                                    '<div style="display: flex;">' +
                                    '<div style="overflow-y: auto; max-height: 60px; flex: 1;">' +
                                    '<img src="<?= base_url(); ?>assets/dist/img/avatar' + potoBox + '" class="mr-3 img-circle" alt="User Avatar" style="width: 50px; height: 50px;">' +
                                    '</div>' +
                                    '<div style="overflow-y: auto; max-height: 60px; max-width: 160px;" class="text-left">' +
                                    '<p class="text-nowrap" style="margin:0px; max-width:150px;">' + row.sender_name + ' ';
                                if (row.new_message !== '0') {
                                    rowHtml += '<span class="badge badge-info right">' + row.new_message + '</span>';
                                }
                                rowHtml +=
                                    '</p>' +
                                    '<p style="margin:0px;">' + row.created_at + '</p>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';
                                messagesContainer.append(rowHtml);
                            }
                        });
                        var newScrollHeights = messagesContainer[0].scrollHeight;

                        if (!scrollingC || previousScrollHeight < newScrollHeights) {
                            messagesContainer.scrollTop(newScrollHeights);
                        }
                    }
                },
                error: function(error) {
                    console.log("Error fetching messages:", error);
                }
            });
        }


        messagesContainer.on('scroll', function() {
            scrollingC = messagesContainer.scrollTop() + messagesContainer.innerHeight() < messagesContainer[0].scrollHeight;
        });

        // Panggil fungsi columnMessages untuk pertama kali
        columnMessages();

        // Atur interval untuk memanggil fungsi columnMessages setiap 3000 milidetik (3 detik)
        setInterval(function() {
            columnMessages();
        }, 3000);


        // -- Batas Kolom Pesan -------------------------------------------------------------------------------------------------

        var emptyMessage = $("#empty-message");
        var messageContainer = $("#message-container");
        var sendMessage = $("#send-message-form");
        var scrolling = false;
        var currentSenderId = null;

        function fetchMessages(senderId) {
            currentSenderId = senderId;
            if (currentSenderId === null) {
                emptyMessage.show();
                messageContainer.hide();
                sendMessage.hide();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>get_messages',
                data: {
                    senderId: currentSenderId
                },
                dataType: 'json',
                success: function(response) {
                    if (response === null) {
                        messageContainer.empty();
                        currentSenderId = null;
                    } else if (response.messages !== null && response.messages.length > 0) {
                        var previousScrollHeight = messageContainer[0].scrollHeight;
                        messageContainer.empty();

                        $.each(response.messages, function(index, message) {
                            var potoBox = (message.gender_id === 'GR-001') ? '5.png' : '3.png';
                            if (message.message.trim() !== '') {
                                var messageClass = (message.sender_id == response.current_member_id) ? 'right' : '';
                                var senderName = (message.sender_name === '<?= $this->session->userdata("member_name") ?>') ? 'Anda' : message.sender_name;

                                messageContainer.append(
                                    '<div class="direct-chat-msg ' + messageClass + '">' +
                                    '<div class="direct-chat-infos clearfix">' +
                                    '<span class="direct-chat-name ' + (messageClass === 'right' ? 'float-right' : 'float-left') + '">' + senderName + '</span>' +
                                    '<span class="direct-chat-timestamp ' + (messageClass === 'right' ? 'float-left' : 'float-right') + '">' + message.created_at + '</span>' +
                                    '</div>' +
                                    '<img class="direct-chat-img" src="<?= base_url(); ?>assets/dist/img/avatar' + potoBox + '" alt="User Avatar" style="width: 40px; height: 40px;">' +
                                    '<div class="direct-chat-text">' + message.message + '</div>' +
                                    '</div>'
                                );
                            }
                        });

                        var newScrollHeight = messageContainer[0].scrollHeight;

                        if (!scrolling || previousScrollHeight < newScrollHeight) {
                            messageContainer.scrollTop(newScrollHeight);
                        }
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

        messageContainer.on('scroll', function() {
            scrolling = messageContainer.scrollTop() + messageContainer.innerHeight() < messageContainer[0].scrollHeight;
        });

        setInterval(function() {
            fetchMessages(currentSenderId);
        }, 1000);

        $("#send-message-form").submit(function(event) {
            event.preventDefault();
            var currentMemberId = $("#current-member-id").val();
            var message = $("#message-input").val();

            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>insert_message',
                data: {
                    senderId: currentSenderId,
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

                        var newScrollHeight = messageContainer[0].scrollHeight;
                        messageContainer.scrollTop(newScrollHeight);
                        console.log('Berhasil');
                    } else {
                        console.log("Error inserting message:", response.error);
                    }
                },
                error: function(error) {
                    console.log("Error inserting message:", error);
                }
            });
        });

        fetchMessages(null);

        $(document).on('click', '#select_sender', function() {
            var senderId = $(this).data("sender");
            emptyMessage.hide();
            messageContainer.show();
            sendMessage.show();
            fetchMessages(senderId);
        });
        // $(".btn-select-sender").click(function() {
        //     var senderId = $(this).data("sender");
        //     emptyMessage.hide();
        //     messageContainer.show();
        //     sendMessage.show();
        //     fetchMessages(senderId);
        // });

        // ----------------------------------------------------------------------------------------------------

    });
</script>