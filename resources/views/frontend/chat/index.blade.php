@section('js-scripts')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/dist/perfect-scrollbar.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/css/perfect-scrollbar.min.css">
    <style>
        body {
            background: #f0f0f0;
            max-height: 100vh;
            overflow: hidden;
        }

        #messagesbox {
            height: 350px;
            overflow-y: auto;
            backdrop-filter: blur(1px);
            margin-bottom: 3rem;
        }

        .messagebody {
            border-radius: 1.4rem;
            padding: 0.5rem 1rem;
            display: block;
            width: fit-content;
            margin-bottom: 1rem;
            font-size: 14px;
        }

        .messagebody {
            max-width: 80%;
        }

        .messagebody.senderbox {
            background: #eac3ab;
        }

        .messagebody.receivebox {
            background: #b8fffd;
            /* color: #fff; */
        }

        .senderbox {
            text-align: right;
            margin-left: auto;
        }

        .chatbody {
            border-radius: 1rem;
            background: #fff;

            box-shadow: 0 0 10px #f0f0f0;
        }

        .chatbody-header {
            padding: 1rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            background: #077773;
            color: #fff;
        }

        .chatbody-header h4 {
            font-size: 16px;
        }

        .senderhandlebox input {
            background: #f0f0f0 !important;
            border-color: #077773 !important;
            border-top-left-radius: 5px !important;
            border-bottom-left-radius: 5px !important;
            font-size: 14px;
            font-weight: 300;
            padding-right: 4rem;
        }

        .sendmsgbutton {
            position: absolute;
            right: 5px;
            top: 2px;
            padding: 0;

            color: #077773 !important;
        }

        .message p {
            font-size: 10px;
        }

        .userselectbutton .icon {
            width: 60px;
        }

        .userselectbutton .icon img {
            width: 100%;
            height: 60px;
            border-radius: 50%;
            border: 1px solid #077773;
            object-fit: contain;
            object-position: top;

        }

        .userselectbutton .text {
            width: calc(100% - 70px);
            margin-left: 10px;
        }

        .userselectbutton:not(:last-of-type) {
            border-bottom: 1px solid #dddd;
        }

        #chatUsersbox {
            height: 360px;
        }

        .btn.selecteduser {
            background: #077773 !important;
            color: #fff !important
        }

        #filepreview {
            width: 100%;
            background: #b8fffd;
            padding: 10px;
        }

        .unreadcount {
            /* position: absolute; */
            display: inline-block;
            /* top: 0;
                                            right: 0; */
            width: 20px;
            height: 20px;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            overflow: hidden;
            font-size: 10px;

        }

        @media screen and (max-width: 992px) {
            body {
                max-height: 100%;
                min-height: 100vh;
                overflow: auto;
            }
        }
    </style>
@endsection

@extends('frontend.chat.layout')
@section('content')
    @php
        use App\Http\Controllers\PusherController;
    @endphp
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8">
                @if ($received_id)
                    <div class="w-100  pb-3 position-relative chatbody" id="chatbody">
                        <div class="chatbody-header">
                            <h4 class="mb-0">
                                {{ $receiver->name }}
                            </h4>
                        </div>
                        <div id="messagesbox" class="px-5 py-2">
                            @foreach ($chats->reverse() as $chat)
                                @include('frontend.chat.receive', [
                                    'message' => $chat->message_text,
                                    'chatroomId' => $chat->from_id,
                                    'recever_id' => $chat->to_id,
                                    'receipant' => $receiver->id,
                                    'file' => $chat->file,
                                    'file_name' => $chat->file_name,
                                    'created_at' => $chat->created_at,
                                ])
                            @endforeach
                            @include('frontend.chat.broadcast', ['message' => ''])
                            @if (count($chats) == '0')
                                <div class="message"></div>
                            @endif

                        </div>
                        <div class="w-100 position-absolute senderhandlebox bottom-0 start-0 px-2 pb-2">
                            <div id="filepreview" style="display: none;">
                                <div class="badge bg-primary text-white" id="filenameshow"></div>
                                <div class="w-100 text-end" id="filesendbox">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button onclick="cancelFile()" class="btn btn-sm btn-danger">Cancel</button>
                                        <button onclick="sendFile()" class="btn btn-sm btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                            <form autocomplete="off" id="messagesend">
                                <div class="d-flex position-relative align-items-center">
                                    <input type="hidden" name="recipient_id" id="recipient_id" value="{{ $received_id }}">
                                    <input type="hidden" name="from_id" id="from_id" value="{{ auth()->user()->id }}">
                                    <input type="text" placeholder="Type your message here." name="message"
                                        id="message_text" class="form-control shadow-none">
                                    <div class="d-inline-flex align-items-center sendmsgbutton">
                                        <label for="filedoc" class="btn p-0 text-success  border-0">
                                            <input onchange="fileupdated(event)" accept=".pdf, .word, .xlsx, .xlx"
                                                type="file" id="filedoc" class="d-none" />
                                            <i class="fa-solid fa-paperclip"></i>
                                        </label>
                                        <button class="btn  border-0 text-success">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                @endif
            </div>
            <div class="col-md-4">
                <div id="chatUsersbox" class="position-relative overflow-hidden">
                    <ul class="list-unstyled mb-0 p-0 w-100 position-sticky top-0">
                        @foreach ($items as $item)
                            <li class="mb-2 w-100">
                                <a href="{{ route('chat', ['receipt_id' => $item->id]) }}"
                                    class="btn @if ($receiver && $receiver->id === $item->id) selecteduser @endif d-block w-100 text-start border userselectbutton bg-white">
                                    <div class="d-flex w-100 align-items-center position-relative">
                                        <div class="icon">
                                            @if ($item->designation == 'Expert')
                                                <img src="{{ url('public/upload/' . $item->expertdata?->profile_image) }}"
                                                    alt="" class="img-fluid">
                                            @endif
                                            @if ($item->designation == 'User')
                                                <img src="https://static-00.iconduck.com/assets.00/user-icon-2048x2048-ihoxz4vq.png"
                                                    alt="" class="img-fluid">
                                            @endif
                                        </div>
                                        <div class="text">
                                            {{ $item->name }}
                                            @php
                                                $counts = PusherController::get_unread_msg($item->id);
                                            @endphp
                                            @if ($counts['to'] == auth()->user()->id && $counts['count'] > 0 )
                                                <span class="unreadcount bg-danger text-white">
                                                    {{ $counts['count'] }}
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        const sendFile = () => {
            $("#messagesend").submit();
        }
        const cancelFile = () => {
            $("#filepreview").hide();
            $("#filesendbox").hide();
        }
        const fileupdated = (event) => {
            const files = event.target.files;
            const fileName = files[0].name;
            $("#filenameshow").text(fileName);
            $("#filepreview").show();
            $("#filesendbox").show();
        }
        if ($("#messagesbox")[0]) {
            const ps = new
            PerfectScrollbar('#messagesbox', {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        }
        if ($("#chatUsersbox")[0]) {
            const ps = new
            PerfectScrollbar('#chatUsersbox', {
                wheelSpeed: 2,
                wheelPropagation: true,
                minScrollbarLength: 20
            });
        }


        Pusher.logToConsole = true;
        var pusher = new Pusher('06f87495983ef3a4aad9', {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('chatroom' + "{{ auth()->user()->id }}");
        channel.bind('chat-message', function(data) {
            let channelId = data.senderId;
            let recever_id = data.recipientId;
            console.log(recever_id + 'receiver id');
            console.log("{{ auth()->user()->id }}" + 'My id');
            console.log(channelId + 'Sender id');
            console.log("{{ $received_id }}" + 'Select Received id');
            $.post("{{ route('receive_message') }}", {
                '_token': "{{ csrf_token() }}",
                'message': data.message,
                'chatroomId': channelId,
                'recever_id': recever_id,
                'file': data.file,
                'file_name': data.file_name,
                'created_at': data.created_at
            }).done((res) => {
                $("#messagesbox > .message").last().after(res);
                $("#messagesbox").scrollTop($("#messagesbox")[0].scrollHeight);
            })
        });
        channel.bind('pusher:member_added', function(member) {
            console.log(member)
        })

        $("#messagesend").submit(function(e) {
            e.preventDefault();
            let bsurl = "{{ route('send-message') }}";
            let token = "{{ csrf_token() }}";
            let formData = new FormData();
            formData.append('_token', token);
            formData.append('recipient_id', $("#recipient_id").val());
            formData.append('from_id', $("#from_id").val());
            formData.append('message', $("#message_text").val());
            formData.append('file', $('#filedoc')[0].files[0]);
            $.ajax({
                url: bsurl,
                method: "POST",
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: formData,
                contentType: false,
                processData: false // Ensure JQuery does not process data or set content type
            }).done(function(res) {
                $("#filenameshow").text('');
                $("#filepreview").hide();
                $("#filesendbox").hide();
                $("#messagesend").trigger('reset')
                $("#messagesbox > .message").last().after(res);
                $("#messagesbox").scrollTop($("#messagesbox")[0].scrollHeight);
            });
        });
        if ($("#messagesbox")[0]) {
            $("#messagesbox").scrollTop($("#messagesbox")[0].scrollHeight);
        }
    </script>
@endsection
