<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>        
      </li>      
    </ul>
    <style>
      .warna {
      animation: color-change 1s infinite;
      }

    @keyframes color-change {
      0% { color: red; }
      50% { color: green; }
      100% { color: blue; }
    }
    </style>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <marquee class="warna">
        Welcome <b>  {{auth::user()->name}} // 
        </b> Email <b>  {{auth::user()->email}} </b> //
        Dept <b> {{auth::user()->dept}} </b> // 
        NPK <b> {{auth::user()->npk}} </b>
      </marquee>
      </li>      
    </ul>
  </nav>
