<div id="create-sale-modal" 
     class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50"
     role="dialog" aria-modal="true" aria-labelledby="saleModalTitle">

  <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
    <div class="flex justify-between items-center border-b pb-3">
      <h1 id="saleModalTitle" class="text-2xl font-semibold text-gray-800">Nova Venda</h1>
      <button onclick="closeModal('create-sale-modal')" 
              class="text-gray-600 hover:text-gray-900 text-2xl leading-none font-bold">
          &times;
      </button>
    </div>

    <form action="{{ route('sales.store') }}" method="POST" class="space-y-4 mt-4" id="createSaleForm">
      @csrf
      <input type="hidden" name="client_id" value="{{ $client->id }}">
      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">Valor (R$)</label>
        <input type="text" name="amount" id="amount" required
        class="mt-1 w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
        inputmode="numeric" autocomplete="off">
 
      </div>
      
      <div>
        <label for="date" class="block text-sm font-medium text-gray-700">Data da Venda</label>
        <input type="date" name="date" id="date" required
               class="mt-1 w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
      </div>
      
      <div>
        <label for="received" class="block text-sm font-medium text-gray-700">Recebida?</label>
        <select name="received" id="received"
                class="mt-1 w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </select>
      </div>

      <div class="flex justify-end gap-2 pt-2 border-t mt-6">
        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md transition">
          Salvar
        </button>
        <button type="button" onclick="closeModal('create-sale-modal')"
                class="px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100">
          Cancelar
        </button>
      </div>
    </form>
  </div> 
</div>

<script>
  function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add('hidden');
    modal.classList.remove('flex');

    // Limpa o formulário ao fechar
    const form = modal.querySelector('form');
    if (form) form.reset();
  }

  document.addEventListener("DOMContentLoaded", () => {
    const amountInput = document.getElementById('amount');

    amountInput.addEventListener('input', (e) => {
      let value = e.target.value.replace(/\D/g, '');
      value = (parseInt(value) / 100).toFixed(2) + '';
      value = value.replace(".", ",");
      value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

      e.target.value = value;
    });

    // Corrige valor para submissão no formato aceito pelo backend
    const form = document.getElementById('createSaleForm');
    form.addEventListener('submit', (e) => {
      const raw = amountInput.value.replace(/\./g, '').replace(',', '.');
      amountInput.value = raw;
    });
  });
</script>
