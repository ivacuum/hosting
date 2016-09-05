<template>
  <div>
    <p class="lead">А еще лучше слетать <a class="link pseudo" @click.prevent="aviasales">повидать новый город</a>.</p>
    <div id="aviasales_container"></div>
  </div>
</template>

<script>
export default {
  ready() {
    console.log('Aviasales ready.');
  },

  methods: {
    aviasales(e) {
      $(e.target).contents().unwrap();

      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.src = 'https://www.travelpayouts.com/widgets/044c854e39d539701be0fa773757da42.js?v=443';
      s.async = true;
      document.getElementById('aviasales_container').appendChild(s);
    }
  }
};
</script>
