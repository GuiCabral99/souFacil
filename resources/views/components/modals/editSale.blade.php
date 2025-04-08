{{-- <div id="editSaleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Editar Venda</h2>
  
        <form method="POST" id="editSaleForm">
            @csrf
            @method('PUT')
  
            <input type="hidden" name="client_id" id="edit_client_id">
  
            <div class="mb-4">
                <label for="edit_amount" class="block text-sm font-medium">Valor (R$)</label>
                <input type="text" name="amount" id="edit_amount" class="w-full border p-2 rounded" required>
            </div>
  
            <div class="mb-4">
                <label for="edit_date" class="block text-sm font-medium">Data da Venda</label>
                <input type="date" name="date" id="edit_date" class="w-full border p-2 rounded" required>
            </div>
  
            <div class="mb-4">
                <label for="edit_received" class="block text-sm font-medium">Recebida?</label>
                <select name="received" id="edit_received" class="w-full border p-2 rounded">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
  
            <div class="flex justify-end space-x-2">
                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
                    <button type="button" onclick="closeModal('editSaleModal')" class="text-gray-600 hover:text-gray-800">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
  </div> --}}

  
  <div id="editSaleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Editar Venda</h2>
        
        <!-- Formulário de Edição -->
        <form method="POST" id="editSaleForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="client_id" id="edit_client_id">
            
            <div class="mb-4">
                <label for="edit_amount" class="block text-sm font-medium">Valor (R$)</label>
                <input type="text" name="amount" id="edit_amount" class="w-full border p-2 rounded" required>
            </div>
            
            <div class="mb-4">
                <label for="edit_date" class="block text-sm font-medium">Data da Venda</label>
                <input type="date" name="date" id="edit_date" class="w-full border p-2 rounded" required>
            </div>
            
            <div class="mb-4">
                <label for="edit_received" class="block text-sm font-medium">Recebida?</label>
                <select name="received" id="edit_received" class="w-full border p-2 rounded">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            
            <div class="flex justify-between items-center">
                <!-- Botão de Exclusão (fora do formulário de edição) -->
                <button 
                    type="button"
                    onclick="confirmDelete()"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Excluir Venda
                </button>
                
                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Salvar</button>
                    <button type="button" onclick="closeModal('editSaleModal')" class="text-gray-600 hover:text-gray-800">Cancelar</button>
                </div>
            </div>
        </form>
        
        <!-- Formulário de Exclusão (hidden) -->
        <form method="POST" id="deleteSaleForm" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    let currentSaleId = null;
    
    function openEditSaleModal(sale) {
        const modal = document.getElementById('editSaleModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        document.getElementById('edit_amount').value = sale.amount;
        const editDateInput = document.getElementById('edit_date');
        if (sale.date) {
            const [year, month, day] = sale.date.split('T')[0].split('-');
            editDateInput.value = `${year}-${month}-${day}`;
        }
        document.getElementById('edit_received').value = sale.received ? 1 : 0;
        document.getElementById('edit_client_id').value = sale.client_id;
        
        currentSaleId = sale.id;
        document.getElementById('editSaleForm').action = `/sales/${sale.id}`;
        document.getElementById('deleteSaleForm').action = `/sales/${sale.id}`;
    }
    
    function confirmDelete() {
        if (confirm('Tem certeza que deseja excluir esta venda?')) {
            document.getElementById('deleteSaleForm').submit();
        }
    }
</script>