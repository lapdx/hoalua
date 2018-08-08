@extends('auth.layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center" style="padding-top:30px;padding-bottom:30px;">
                <img src="{{ asset('images/logo.png') }}" alt="logo">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Register system Hoalua</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="<?= url('/register') ?>">
                            <?= csrf_field() ?>

                            <div class="form-group<?= $errors->has('name') ? ' has-error' : '' ?>">
                                <label for="name" class="col-md-4 control-label"><strong>Name</strong></label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="<?= old('name') ?>" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong><?= $errors->first('name') ?></strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group<?= $errors->has('email') ? ' has-error' : '' ?>">
                                <label for="email" class="col-md-4 control-label"><strong>E-Mail Address</strong></label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="<?= old('email') ?>">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong><?= $errors->first('email') ?></strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group<?= $errors->has('password') ? ' has-error' : '' ?>">
                                <label for="password" class="col-md-4 control-label"><strong>Password</strong></label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong><?= $errors->first('password') ?></strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group<?= $errors->has('password_confirmation') ? ' has-error' : '' ?>">
                                <label for="password-confirm" class="col-md-4 control-label"><strong>Confirm Password</strong></label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong><?= $errors->first('password_confirmation') ?></strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-users"></i> Register
                                    </button>
                                    <a class="btn btn-success" href="/login"><i class="fa fa-sign-in"></i> Login</a>
                                </div>
                            </div>
                            <div class="form-group text-center" style="padding-top:30px;">
                                <strong>Copyright &copy; 2018 <a href="{{ env('APP_URL') }}" target="_blank">Hoalua</a>.</strong> All rights
                                reserved.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
