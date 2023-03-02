<div class="mt-20 bg-gray-50 py-10 px-5 rounded-lg">
  <div class="mb-10 text-2xl font-medium text-center">Peta Indeks</div>
  <object id="peta" class="w-full h-[600px]" type="image/svg+xml" data="{{ asset('peta.svg') }}"></object>
  <div class="flex items-center flex-col lg:flex-row lg:space-x-6 mt-6 justify-center">
    <div class="flex items-center whitespace-nowrap">
      <div class="py-2 px-4 mr-3" style="background-color: red"></div>
      <div>Rawan</div>
    </div>
    <div class="flex items-center whitespace-nowrap">
      <div class="py-2 px-4 mr-3" style="background-color: yellow"></div>
      <div>Waspada</div>
    </div>
    <div class="flex items-center whitespace-nowrap">
      <div class="py-2 px-4 mr-3" style="background-color: green"></div>
      <div>Aman</div>
    </div>
  </div>

  <table class="w-full table-fixed rounded-md overflow-hidden my-8">
    <thead>
      <tr class="focus:outline-none border border-green-500 bg-green-500/10">
        <th class="border py-2 px-8 text-green-500 font-medium">Kecamatan</th>
        <th class="border py-2 px-8 text-green-500 font-medium">Nilai</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($dataset as $item)
        <tr class="focus:outline-none h-16 border border-gray-100 odd:bg-white even:bg-gray-50">
          <td class="border py-3 px-8">{{ $item->district }}</td>
          <td class="border py-3 px-8">{{ $item->value }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@push('script')
<script>
  const object = document.querySelector('#peta');

  const dataset = @json($dataset->map->only(['district', 'value']));
  const maxValue = Math.max(...dataset.map(({ value }) => value));
  const colors = ['red', 'yellow', 'green'];

  colors.forEach((color, index) => {
    const threshold = (maxValue / colors.length);
    const boundariesMax = threshold * (index + 1);

    colors[index] = {
      color,
      boundaries: {
        min: boundariesMax - threshold,
        max: boundariesMax,
      },
    };
  });

  const renderColors = () => {
    object.onload = () => {
      const map = object.contentDocument.querySelector('svg');
      const districts = map.querySelectorAll('path');
      const districtLabel = document.querySelector('#district-label');

      districts.forEach((element) => {
        const district = element.getAttribute('district').toLowerCase();
        const districtValue = dataset.filter(({ district: key }) => key.toLowerCase() === district )[0]?.value;

        if (districtValue !== undefined) {
          for (const dataColor of colors) {
            if (districtValue >= dataColor.boundaries.min && districtValue <= dataColor.boundaries.max) {
              element.style.fill = dataColor.color;
              break;
            }
          }
        }
      });
    }
  }

  (function () {
    renderColors();
  })();
</script>
@endpush
