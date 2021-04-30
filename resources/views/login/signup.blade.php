<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/froala-design-blocks/2.0.0/css/froala_blocks.min.css">
</head>

<body>

    <section class="fdb-block" style="background-image: url(imgs/hero/red.svg);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-center">
                <form action="{{route('post.signup')}}" method="POST">
                    @csrf
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>{{ Session::get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    @endif
                    <div class="fdb-box">
                        <div class="row">
                            <div class="col">
                                <h1>S’inscrire</h1>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <input type="text" class="form-control" name="nom" placeholder="Prénom" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <input type="text" class="form-control" name="prenom" placeholder="Nom" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <input type="text" class="form-control" name="login" placeholder="Identifiant" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <input type="password" class="form-control mb-1" name="mdp" placeholder="Mot de passe" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">

                                <select name="formation" id="formation" class="form-control" required="required">
                                @foreach($formations as $key => $f)
                                    <option value="{{$f->id}}">{{$f->intitule}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="col">
                                <a href="{{route('login')}}" >Login</a>
                            </div>
                            <div class="col d-block">
                                <button class="btn btn-outline-secondary" type="submit">Soumission</button>

                            </div>
                        </div>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </section>

    </body>
</html>
