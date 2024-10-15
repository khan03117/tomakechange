<!-- Modal -->
<div class="modal fade" id="staticBackdrop{{ $expert_id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel{{ $expert_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="staticBackdropLabel{{ $expert_id }}">
                    Get An Appointment
                </h1>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Make the form ID unique by appending the expert_id -->
                <form class="text-start appointment_form" id="appointment_form_{{ $expert_id }}">
                    <div class="form-group" id="alertmessage_{{ $expert_id }}" style="display: none">
                        <div class="alert alert-success">
                            Your appointment request has been sent successfully.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" name="name" id="name_{{ $expert_id }}" class="form-control">
                        <input type="hidden" name="expert_id" id="expert_id_{{ $expert_id }}"
                            value="{{ $expert_id }}">
                        <input type="hidden" name="search_id" value="{{ $search_id }}">
                        <span class="text-danger" id="name_error_{{ $expert_id }}"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="text" name="email" id="email_{{ $expert_id }}" class="form-control">
                        <span class="text-danger" id="email_error_{{ $expert_id }}"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Mobile</label>
                        <input type="text" name="mobile" id="mobile_{{ $expert_id }}" class="form-control">
                        <span class="text-danger" id="mobile_error_{{ $expert_id }}"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Time to Contact</label>
                        <input type="datetime-local" name="appointment_at" id="appointment_at_{{ $expert_id }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary w-100" type="submit">Submit</button>
                    </div>
                </form>
                <!-- Update the script to handle unique form IDs -->
                <script>
                    $("#appointment_form_{{ $expert_id }}").on('submit', function(e) {
                        e.preventDefault();
                        const fdta = $(this).serialize();
                        $("#name_error_{{ $expert_id }}").html('')
                        $("#email_error_{{ $expert_id }}").html('')
                        $("#mobile_error_{{ $expert_id }}").html('')
                        $.ajax({
                            url: "{{ route('appointment.store') }}",
                            data: fdta,
                            method: "POST",
                            success: function(resp) {
                                if (resp.success == "0") {
                                    if (resp.errors?.name && resp.errors?.name.length > 0) {
                                        $("#name_error_{{ $expert_id }}").html(resp.errors?.name[0])
                                    }
                                    if (resp.errors?.email && resp.errors?.email.length > 0) {
                                        $("#email_error_{{ $expert_id }}").html(resp.errors?.email[0])
                                    }
                                    if (resp.errors?.mobile && resp.errors?.mobile.length > 0) {
                                        $("#mobile_error_{{ $expert_id }}").html(resp.errors?.mobile[0]);
                                    }



                                    $("#alertmessage_{{ $expert_id }}").hide();
                                } else {
                                    $("#name_error_{{ $expert_id }}").html('')
                                    $("#email_error_{{ $expert_id }}").html('')
                                    $("#mobile_error_{{ $expert_id }}").html('')
                                    $("#alertmessage_{{ $expert_id }}").show();
                                    $("#appointment_form_{{ $expert_id }}").trigger('reset')
                                }


                            },
                            error: function(xhr) {
                                console.log(xhr.response);
                            }
                        });
                    });
                </script>
            </div>

        </div>
    </div>
</div>
