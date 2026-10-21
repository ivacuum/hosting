<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#020618" media="(prefers-color-scheme: dark)">
<title>{{ $metaTitle ?? '' }}</title>
<style>
body {
  box-sizing: border-box;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  min-height: 100dvh;
  margin: 0;
  padding: 1.5rem max(1rem, env(safe-area-inset-right)) 1.5rem max(1rem, env(safe-area-inset-left));
  color: #a0aec0;
  font-weight: 100;
  font-family: ui-rounded, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
}

@media (prefers-color-scheme: dark) {
  body {
    background: #020618;
    color: #94a3b8;
  }
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

.title {
  max-width: 20em;
  font-size: clamp(2rem, 9vw, 54px);
  line-height: 1.2;
  text-align: center;
  text-wrap: balance;
  overflow-wrap: break-word;
}
</style>
</head>
<body>
<div class="title">
  @yield('content')
  <br><br>
  <a href="{{ to('/') }}">
    @svg (home)
  </a>
</div>
</body>
</html>
