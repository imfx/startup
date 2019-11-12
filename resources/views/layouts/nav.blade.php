<nav class="navbar navbar-expand-lg navbar-light fixed-top py-4">
	<div class="container d-flex justify-content-between">
		<a class="navbar-brand" href="#">{{ env('APP_NAME') }}</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Link</a>
				</li>

				@if (auth()->check())
					<li class="nav-item dropdown">
						<a class="nav-link" href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="avatar avatar-xs">
								<span class="avatar-title rounded-circle">CF</span>
							</div>
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Mi Perfil</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
							<form
				              id="logout-form"
				              action="{{ route('logout') }}"
				              method="POST"
				              class="d-none">
				              @csrf
				            </form>
						</div>
					</li>
				@else
					<li class="nav-item">
						<a class="btn btn-outline-primary btn-sm mr-3 nav-link" href="{{ route('login') }}">
							Iniciar Sesión
						</a>
					</li>
					<li>
						<a class="btn btn-primary btn-sm nav-link" href="{{ route('register') }}">
							Crear una Cuenta
						</a>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>
