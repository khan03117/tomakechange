<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <title>Default Meeting UI | EDHA UI Kit</title>

    <head>
        <script type="module">
            import {
                defineCustomElements
            } from 'https://cdn.jsdelivr.net/npm/@dytesdk/ui-kit@1.53.0/loader/index.es2017.js';
            defineCustomElements();
            import {
                sendNotification
            } from 'https://cdn.jsdelivr.net/npm/@dytesdk/ui-kit@1.59.0/dist/esm/index.js'
            window.sendNotification = sendNotification;
        </script>

        <!-- Import Web Core via CDN too -->
        <script src="https://cdn.dyte.in/core/dyte-1.16.0.js"></script>
    </head>
</head>

<body>

    <dyte-meeting id="my-meeting" show-setup-screen="true" />

    <script>
        // let authToken = "{{ $token }}";
        // DyteClient.init({
        //     authToken
        // }).then((meeting) => {
        //     document.getElementById('my-meeting').meeting = meeting;
        // });
         document.addEventListener('DOMContentLoaded', async () => {
             let authToken = "{{ $token }}"; 
            try {
                const meeting = await DyteClient.init({
                    authToken
                });

                document.getElementById('my-meeting').meeting = meeting;

                // Listen for the event when a participant leaves the meeting
                meeting.self.on('roomLeft', () => {
                    window.location.href = "{{url('/')}}";
                });

            } catch (error) {
                console.error('Error initializing Dyte meeting:', error);
            }
         })
    </script>
    <script>
        const get_participant = () => {
            var settings = {
                "url": "https://api.cluster.dyte.in/v2/meetings/{{ $slot['meet_id'] }}/participants",
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Authorization": "Basic {{ $auth }}"
                },
            };
            //     $.ajax(settings).done(function (response) {
            //      let id = response.data[0].id;
            //      setTimeout(() => {
            //          delete_participant(id);
            //          mark_complete();
            //         window.location.href = "{{ url('/') }}"
            //         }, "{{ $slot['duration'] * 1000 * 60 }}")
            //          setTimeout(() => {
            //         alert('10 Minutes left.');

            //         }, "{{ $slot['duration'] * 60000 - $slot['duration'] * 60000 * 0.8 }}")

            //     });
            // }
            $.ajax(settings).done(function(response) {
                let id = response.data[0].id;
                let slotDuration = {{ $slot['duration'] }};

                let timeRemaining = slotDuration * 60 * 1000;

                setTimeout(() => {
                    delete_participant(id);
                    mark_complete();
                    window.location.href = "{{ url('/') }}";
                }, timeRemaining);

                let alertTime = timeRemaining - (10 * 60 * 1000);

                setTimeout(() => {
                    alert('10 Minutes left.');
                }, alertTime);
            });
        };
        get_participant();
        const delete_participant = (id) => {
            var settings = {
                "url": "https://api.cluster.dyte.in/v2/meetings/{{ $slot['meet_id'] }}/participants/" + id,
                "method": "DELETE",
                "timeout": 0,
                "headers": {
                    "Authorization": "Basic {{ $auth }}"
                },
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
            });
        }
        const mark_complete = () => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post(`https://edha.life/expert/mark_completed/{{ $usid }}`, {}, function(res) {
                console.log(res);
            })
        }
    </script>

</body>

</html>
