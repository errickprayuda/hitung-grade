<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grading</title>
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="mb-3 row">
    <h1 style="text-align: center">Hitung Grade</h2>
    </div>  
    <form id="nilai">
        @csrf
        <div class="mb-3 row">
            <label for="quiz" class="col-sm-1 col-form-label offset-md-5">Quiz</label>
            <div class="col-sm-1">
            <input type="number" class="form-control" id="quiz" min="0" max="100">
            </div>
            <span class="col-sm-4 text-danger" id="quiz-error"></span>
        </div>
        <div class="mb-3 row">
            <label for="tugas" class="col-sm-1 col-form-label offset-md-5">Tugas</label>
            <div class="col-sm-1">
            <input type="number" class="form-control" id="tugas" min="0" max="100">
            </div>
            <span class="col-sm-4 text-danger" id="tugas-error"></span>
        </div>
        <div class="mb-3 row">
            <label for="absensi" class="col-sm-1 col-form-label offset-md-5">Absensi</label>
            <div class="col-sm-1">
            <input type="number" class="form-control" id="absensi" min="0" max="100">
            </div>
            <span class="col-sm-4 text-danger" id="absensi-error"></span>
        </div>
        <div class="mb-3 row">
            <label for="praktek" class="col-sm-1 col-form-label offset-md-5">Praktek</label>
            <div class="col-sm-1">
            <input type="number" class="form-control" id="praktek" min="0" max="100">
            </div>
            <span class="col-sm-4 text-danger" id="praktek-error"></span>
        </div>
        <div class="mb-3 row">
            <label for="uas" class="col-sm-1 col-form-label offset-md-5">UAS</label>
            <div class="col-sm-1">
            <input type="number" class="form-control" id="uas" min="0" max="100">
            </div>
            <span class="col-sm-4 text-danger" id="uas-error"></span>
        </div>
    <div class="mb-3 row">
        <button type="button" class="btn btn-primary col-sm-2 offset-md-5" id="submit">Submit</button>
    </div>
    </form>
    <div class="mb-3 row justify-content-center">
        <label for="grade" class="col-sm-1 col-form-label">Grade</label>
        <div class="col-sm-1">
        <input type="text" class="form-control" id="grade" readonly>
        </div>
    </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('#submit').click(function(){
            $('#grade').val(null);
            $('#quiz-error').text(null);
            $('#tugas-error').text(null);
            $('#absensi-error').text(null);
            $('#praktek-error').text(null);
            $('#uas-error').text(null);
            $.ajax({
                url : "{{ route('hitunggrade.hitung') }}",
                type : 'post',
                data : {
                    quiz : $('#quiz').val(),
                    tugas : $('#tugas').val(),
                    absensi : $('#absensi').val(),
                    praktek : $('#praktek').val(),
                    uas : $('#uas').val(),
                    "_token" : "{{ csrf_token() }}"
                },
                success : function (response){
                    $('#grade').val(response.grade)
                },
                error : function (xhr){
                    console.log(xhr);
                    if(xhr.status == 422){
                        $('#quiz-error').text(xhr.responseJSON.errors.quiz);
                        $('#tugas-error').text(xhr.responseJSON.errors.tugas);
                        $('#absensi-error').text(xhr.responseJSON.errors.absensi);
                        $('#praktek-error').text(xhr.responseJSON.errors.praktek);
                        $('#uas-error').text(xhr.responseJSON.errors.uas);
                    } else {
                    alert(xhr.responseJSON.text);
                    }
                }
            })
        })
    </script>
</body>
</html>