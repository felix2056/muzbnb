<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ url('style/assets') }}/img/close.svg" alt="close"></button>
    <h4 class="modal-title" id="myModalLabel">Reset Password.</h4>
</div>
<div class="modal-body">
    <div class="login-form" style="padding-bottom: 0px;">
        <div class="alert hide" id="notification_message" style="font-size: 16px;"></div>

        <form class="form-horizontal" id="send_reset_link" role="form" method="POST" action="{{ route('passwordReset') }}">
            {{ csrf_field() }}
            <div class="form-group" style="padding: 10px;">
                <label>Enter the email address associated with your account, and we'll email you a link to reset your password.</label>
                <span class="input-group-addon" style="line-height: 67px;"><img src="{{ url('style/assets') }}/img/mail.svg" alt="mail"></span>
                <input type="email" name="email" id="reset_email" tabindex="1" style="border-radius: 8px; padding: 12px 38px 8px 8px;line-height: 20px;"
                       placeholder="MUZ@MUZBNB.COM" class="form-control">
            </div>

            <div class="form-group">
                <div class="col-md-6 text-left" style="font-size: 17px; padding-top: 18px;">
                    <a href="javascript:;" style="color: royalblue;" class="back-to-login">< Back to Login</a>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-login send-reset-link" style="border-radius: 8px; height: 41px;">
                        Send Reset Link
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
