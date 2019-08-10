<script>
export default {
  data() {
    return {
      input: '',
      categoryId: '',
    }
  }
}
</script>

<template>
<div class="row">
  <div class="col-lg-6">
    <form method="post">
      <div class="form-group">
        <select required class="custom-select" v-model="categoryId">
          <option value="">Выберите рубрику...</option>
        </select>
      </div>

      <div class="form-group">
        <input required class="form-control" v-model="input" placeholder="Ссылка или инфо-хэш">
        <div class="form-help">Ссылка вида <span class="text-success">http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида <span class="text-success">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span></div>
      </div>

      <button class="btn btn-primary">
        {{ $t('torrents.create') }}
      </button>
    </form>
  </div>
  <div class="col-lg-6 mt-4 mt-lg-0">
    <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
  </div>
</div>
</template>
