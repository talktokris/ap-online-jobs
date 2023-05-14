
<section class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('images/naukri_Logo.png')}}" class="img-fluid"></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Jobs</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Employer
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 bgcolor">
                                            <span class="text-uppercase">Category 1</span>
                                            <ul class="nav flex-column">
                                                <li class=""> <a class=" active" href="#">Active</a> </li>
                                                <li class="">  <a class="" href="#">Link item</a> </li>
                                                <li class=""> <a class="" href="#">Link item</a>  </li>
                                            </ul>
                                        </div>
                                    </div><!--  /.row  -->
                                </div><!--  /.container  -->
                            </div><!--  /.dropdown-menu  -->
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Organizations
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 bgcolor">
                                            <ul class="nav flex-column">
                                                <li class=""> <a class=" active" href="#">Active</a> </li>
                                                <li class="">  <a class="" href="#">Link item</a> </li>
                                                <li class=""> <a class="" href="#">Link item</a>  </li>
                                                <li class=""> <a class=" active" href="#">Active</a> </li>
                                                <li class="">  <a class="" href="#">Link item</a> </li>
                                                <li class=""> <a class="" href="#">Link item</a>  </li>
                                            </ul>
                                        </div><!-- /.col-md-4  -->
                                        <div class="col-md-4 bgcolor">
                                            <ul class="nav flex-column">
                                                <li class=""> <a class=" active" href="#">Active</a> </li>
                                                <li class="">  <a class="" href="#">Link item</a> </li>
                                                <li class=""> <a class="" href="#">Link item</a>  </li>
                                                <li class=""> <a class=" active" href="#">Active</a> </li>
                                                <li class="">  <a class="" href="#">Link item</a> </li>
                                                <li class=""> <a class="" href="#">Link item</a>  </li>
                                            </ul>
                                        </div><!-- /.col-md-4  -->
                                    </div><!--  /.row  -->
                                </div><!--  /.container  -->
                            </div><!--  /.dropdown-menu  -->
                        </li>
                        <li class="nav-item"> <a class="nav-link domestic-maids-menu" href="{{route('maids')}}"> Domestic Maids </a> </li>
                        <li class="nav-item"> <a class="nav-link general-workers-menu" href="{{route('workers')}}"> General Workers </a> </li>
                        @guest                               
                        <li class="nav-item"> <a class="nav-link" data-toggle="modal" data-target="#loginModal" href="#"> Login </a> </li>
                        @endguest
                        @auth
                        <li class="nav-item dropdown">
                                {{-- <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><img class="menu-user-avatar" src="{{Auth::user()->profile->image != '' ? asset('storage/'.Auth::user()->profile->image) :  asset('images/avatar.jpg')}}" alt=""><i class="fa fa-angle-down class-trigger"></i></a> --}}
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 bgcolor">
                                            <span class="text-uppercase">Category 1</span>
                                            <ul class="nav flex-column">
                                                <li class=""> <a class=" active" href="#">Active</a> </li>
                                                <li class="">  <a class="" href="#">Link item</a> </li>
                                                <li class=""> <a class="" href="#">Link item</a>  </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                        <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                                                    </a>
                                                </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div>
                                    </div><!--  /.row  -->
                                </div><!--  /.container  -->
                            </div><!--  /.dropdown-menu  -->
                        </li>
                        @endauth
                    </ul>
                    
                    <ul class="navbar-nav ml-auto bgcolor">
                        <li class="nav-item dropdown text-right">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">   
                            Employers Area
                            </a>  
                            <div class="dropdown-menu bgcolor text-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item bgcolor  " href="#">Link 1</a>
                                <a class="dropdown-item bgcolor" href="#">Link 2 </a>
                            </div>
                        </li>
                    </ul>
                </div><!--  /.collapse navbar-collapse  -->
            </nav>
        </div><!--  /.container  -->
    </section>