<th class="md:text-left whitespace-nowrap">
  {{ isset($key) && $slot->isEmpty() ? ViewHelper::modelFieldTrans($modelTpl, $key) : $slot }}
</th>
