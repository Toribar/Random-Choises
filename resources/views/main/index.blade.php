<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<title>Generator timova</title>

	</head>



	<body>
		<div class="container">
			<h1 class="page-header">Generator timova</h1>

			@if ($errorMessage = Session::get('errorMessage'))
				<div class="alert alert-warning">{{ $errorMessage }}</div>
			@endif

			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<a class="btn btn-danger btn-xs pull-right" href="{{ url('clear') }}">
								<span class="glyphicon glyphicon-trash"> </span>
							</a>
						Lista igrača koji će bitku biti
						</div>

						<ul class="list-group">
							@forelse ($questions as $serial => $player)
								<li class="list-group-item">{{$serial + 1}}. {{ $player }}</li>
							@empty
								<li class="list-group-item text-muted">Unesite sve igrače</li>
							@endforelse
						</ul>

						<div class="panel-body">
							<form action="{{ url('add') }}" method="post">
								<div class="input-group">
							      	<input name="newQuestion" type="text" class="form-control" placeholder="Unesite igrača...">

								    <span class="input-group-btn btn-primary">
								       	<button class="btn btn-primary" type="submit ">
								        	<span class="glyphicon glyphicon-plus"></span>
								        </button>
								     </span>
							    </div>
						    </form>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading">Nasumično generisan tim</div>

						<ul class="list-group">
							@forelse ($chosenQuestions as $serial => $player)
								<li class="list-group-item">{{$serial + 1}}. {{ $player }}</li>
							@empty
							 	<li class="list-group-item text-muted">Kliknite na random</li>
							@endforelse
						</ul>
					</div>
				</div>
			</div>

			<hr>

			<div class="row">
			   	<div class="col-md-4 col-md-offset-4">
					<form action="{{ url('random') }}" method="post">
						<div class="input-group input-group-lg">
							<input name="count" type="text" class="form-control text-center" placeholder="Broj igraca" value="{{ Session::get('randomCount', 6) }}">

							<span class="input-group-btn">
							   	<button class="btn btn-primary" type="submit ">
									<span class="glyphicon glyphicon-refresh"></span>Generiši tim
								 </button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>
