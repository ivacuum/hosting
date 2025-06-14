<th class="md:text-right whitespace-nowrap">
  {{ $slot->isEmpty() ? ViewHelper::modelFieldTrans($modelTpl, $key) : $slot }}
</th>
