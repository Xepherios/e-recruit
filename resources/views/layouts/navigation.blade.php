<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-default">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">ABC Company | Careers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default"
            aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="index.html">
                            <img src="./assets/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item">
                    <a class="btn btn-warning" href="{{ url('/') }}"> หน้าแรก </a> 
                </li>
                @if ($candidate_info)
                    <li class="nav-item">
                        <a class="btn btn-info" href="{{ url('/profile') }}"> ข้อมูลส่วนตัว </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="{{ url('/logout') }}"> ออกจากระบบ </a> 
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-info" href="{{ url('/register') }}"> ลงทะเบียน </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ url('/login') }}"> เข้าสู่ระบบ </a> 
                    </li>
                @endif 
            </ul>
        </div>
    </div>
</nav>
