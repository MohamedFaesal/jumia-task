<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jumia Task - Mohamed Faesal</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
    <body>

    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">{{('Phone List')}}</h4>
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div><!-- end page title end breadcrumb table table-striped -->
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card" >
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="exampleFormControlInput1">Country</label>
                                            {{Form::select('country_code', ['' => 'Select country'] + \App\Utilities\PhoneUtil::Countries(), request('country_code'), ['class' => 'form-control', 'id' => 'country_code'])}}
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="exampleFormControlInput1">Status</label>
                                            {{Form::select('status', ['' => 'Select a choice' , 'valid' => 'Valid', 'invalid' => 'Not Valid'] , request('status'), ['class' => 'form-control', 'id' => 'status'])}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 text-right col-12">
                                            <input type="submit" value="Search" class="btn btn-primary mr-md-2"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body colored">
                                <div class="row col-lg-9">
                                    <table class="table table-bordered table-striped text-center">
                                        <tr>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>Country Code</th>
                                            <th>Phone num.</th>
                                        </tr>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <th>{{$customer->country}}</th>
                                                <th>{{$customer->isValid ? "OK" : "NOK"}}</th>
                                                <th>+{{$customer->phoneCode}}</th>
                                                <th>{{$customer->phoneNumber }}</th>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
