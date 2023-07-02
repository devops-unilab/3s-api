<div class="container">
    <div class="row">
        <div class="card mb-4">
            <div class="card-body">

                <br><br>

                <div class="container forget-password">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-4 col-md-7 col-sm-12">
                            <div class="panel-body p-3 m-3">
                                <div class="text-center">


                                    <div class="panel">
                                        <h3>Entrar no sistema 3s</h3>

                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input autofocus type="text" size="350" name="login"
                                                class="form-control" value="{{ old('login') }}"
                                                placeholder="Usuario do SIG" autofocus="autofocus">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control" type="password" name="password"
                                                required autocomplete="current-password" placeholder="Senha do SIG">
                                        </div>
                                        {{-- <div class="block mt-4">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox"
                                                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                    name="remember">
                                                <span
                                                    class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                            </label>
                                        </div> --}}



                                        <div class="forgot">
                                            <a href="https://sigadmin.unilab.edu.br/admin/public/recuperar_senha.jsf">Esqueceu
                                                a senha?</a>
                                        </div><br>
                                        <button type="submit" id="botao-login" class="btn-primary btn-lg btn-block">
                                            Entrar
                                        </button>

                                        <input type="hidden" class="btn btn-info btn-md" name="logar" value="Entrar">
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br><br><br><br><br>
            </div>
        </div>

    </div>
</div>
