
<html>

<head>
  <title></title>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../design/style8.css" rel="stylesheet">

    <!-- for popup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</head>

<body>

	<style>
		.nav-link {
			color: green;
		}

		.nav-item>a:hover {
			color: green;
		}

		/*code to change background color*/
		.navbar-nav>.active>a {
			background-color: #C0C0C0;
			color: green;
		}
	</style>
	<ul class="navbar-nav">
		<li class="nav-item active">
			<a class="nav-link" href="#">
				Home
				<span class="sr-only">
					(current)
				</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">
				GeeksForGeeks Interview Prep
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">
				GeeksForGeeks Courses
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled"
				href="#">Disabled</a>
		</li>
	</ul>

	<script>
		$(document).ready(function () {

			$('ul.navbar-nav > li')
					.click(function (e) {
				$('ul.navbar-nav > li')
					.removeClass('active');
				$(this).addClass('active');
			});
		});
	</script>
</body>

</html>
