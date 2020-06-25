<div class="login-form" style="padding-bottom: 0px;">
    <div class="alert hide" id="notification_message" style="font-size: 16px;"></div>

    <form class="form-horizontal" id="update_password" role="form" method="POST" action="{{ route('savePasswordReset', $token) }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label>Password</label>
            <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/lock.png" class="lock-icon" alt="lock"></span>
            <input type="password" name="password" id="password" value="{{ Input::get('password') }}" tabindex="2" class="form-control" placeholder="">
            @if ($errors->has('password'))
                <span class="help-block" style="font-size: 16px;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label>Confirm Password</label>
            <span class="input-group-addon"><img src="{{ url('style/assets') }}/img/lock.png" class="lock-icon" alt="lock"></span>
            <input type="password" name="password_confirmation" id="password_confirmation" value="{{ Input::get('password_confirmation') }}" tabindex="2" class="form-control" placeholder="">
            @if ($errors->has('password_confirmation'))
                <span class="help-block" style="font-size: 16px;">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btn-login save-continue" style="border-radius: 8px; height: 41px;">
                    Save & Continue
                </button>
            </div>
            <div class="col-md-12 text-center">
                <span style="font-size: 13px;">By clicking "Save & Continue" you confirm that you accept the <a href="javascript:;">Terms and Service</a> & <a href="javascript:;">Privacy Policy</a></span>
            </div>
        </div>
    </form>
</div>