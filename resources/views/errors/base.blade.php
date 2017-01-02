<html>
<head>
<title>{{ $meta_title or '' }}</title>
<style>
body {
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  color: #B0BEC5;
  display: table;
  font-weight: 100;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}

a {
  color: #2965be;
  text-decoration: none;
  border-bottom: 1px solid rgba(41, 101, 190, 0.3);
}

a:hover,
a:focus {
  border-color: rgba(210, 50, 50, 0.5);
  color: #d23232;
  text-decoration: none;
}

.svg-icon {
  display: inline-block;
  vertical-align: text-top;
  fill: currentColor;
  width: 1em;
  height: 1em;
  margin-top: 2px;
}

.container {
  text-align: center;
  display: table-cell;
  vertical-align: middle;
}

.content {
  text-align: center;
  display: inline-block;
}

.title {
  font-size: 54px;
  margin-bottom: 40px;
}
</style>
</head>
<body>
<div class="container">
  <div class="content">
    <div class="title">
      @yield('content')
      <br><br>
      <a href="/">
        @svg (home)
      </a>
    </div>
  </div>
</div>
</body>
</html>
