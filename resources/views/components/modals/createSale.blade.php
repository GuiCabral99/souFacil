{{-- <div id="create-sale-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 justify-center items-center hidden">
  <div class="bg-white p-6 rounded shadow-lg">
    <h1 name="title">Nova Venda</h1>

    <form action="{{ route('sales.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id }}">
      
      <div>
          <label for="amount" class="block text-sm font-medium">Valor (R$)</label>
          <input type="number" step="0.01" name="amount" id="amount" class="w-full border p-2 rounded" required>
      </div>
      
      <div>
          <label for="date" class="block text-sm font-medium">Data da Venda</label>
          <input type="date" name="date" id="date" class="w-full border p-2 rounded" required>
      </div>
      
      <div>
          <label for="received" class="block text-sm font-medium">Recebida?</label>
          <select name="received" id="received" class="w-full border p-2 rounded">
              <option value="0">Não</option>
              <option value="1">Sim</option>
          </select>
      </div>
      

        <div class="text-right">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Salvar
            </button>
            <button type="button" onclick="closeModal('create-sale-modal')" class="text-gray-500 hover:text-gray-700">
              Fechar
          </button>
        </div>
    </form>
  </div> 
</div> --}}
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
        <input type="number" step="0.01" name="amount" id="amount" required
               class="mt-1 w-full border border-gray-300 p-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
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
</script>
