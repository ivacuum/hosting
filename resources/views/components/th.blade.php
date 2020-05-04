<th class="md:text-left">
  {{ isset($key) && $slot->isEmpty() ? ViewHelper::modelFieldTrans($modelTpl, $key) : $slot }}
</th>
