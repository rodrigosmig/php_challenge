<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PHP Challenge</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </head>

    <body>
        <div class="container">
            @csrf
            <div class="card-columns d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <h1 class="display-5">Person</h1>
                        <div class="form-group">
                            <label for="person-file">Upload .xml files</label>
                            <input type="file" class="form-control-file" id="person-file" name="file">
                        </div>
                        <button id="btn_person" type="button" class="btn btn-primary">Submit</button>
                        <div>
                            <fieldset>
                                <legend>Log:</legend>
                                <ul id="person-log_list">
                                    
                                </ul>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h1 class="display-5">Ship Order</h1>
                        <div class="form-group">
                            <label for="ship_order-file">Upload .xml files</label>
                            <input type="file" class="form-control-file" id="ship_order-file" name="file">
                        </div>
                        <button id="btn_ship_order" type="button" class="btn btn-primary">Submit</button>
                        <div>
                            <fieldset>
                                <legend>Log:</legend>
                                <ul id="ship_order-log_list">
                                    
                                </ul>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
    </body>
    
</html>