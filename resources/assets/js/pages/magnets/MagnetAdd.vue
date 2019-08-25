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
<div class="lg:flex lg:-mx-4">
  <div class="lg:w-1/2 lg:px-4">
    <form method="post">
      <div class="mb-4">
        <select required class="custom-select" v-model="categoryId">
          <option value="">Выберите рубрику...</option>
        </select>
      </div>

      <div class="mb-4">
        <input required class="form-control" v-model="input" placeholder="Ссылка или инфо-хэш">
        <div class="form-help">Ссылка вида <span class="text-green-600">http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</span><br>или инфо-хэш вида <span class="text-green-600">9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</span></div>
      </div>

      <button class="btn btn-primary">
        {{ $t('torrents.create') }}
      </button>
    </form>
  </div>
  <div class="lg:w-1/2 lg:px-4 mt-6 lg:mt-0">
    <div>Нашли что-то интересное на рутрекере? Поделитесь своей находкой со всеми! Достаточно выбрать подходящую рубрику и вставить ссылку на раздачу. Далее сайт все сделает автоматически — вам даже не нужно скачивать, хэшировать или поддерживать раздачу. Так просто еще никогда не было!</div>
  </div>
</div>
</template>
