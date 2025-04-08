<div id="editClientModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl">
      <div class="flex justify-between items-center border-b pb-3">
        <h2 class="text-2xl font-semibold text-gray-800">Editar Cliente</h2>
        <button onclick="closeModal('editClientModal')" class="text-gray-600 hover:text-gray-900 text-2xl leading-none font-bold">
          &times;
        </button>
      </div>
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <form id="editForm" method="POST" class="space-y-4 mt-4">
        @csrf
        @method('PUT')
  
        <input type="hidden" id="client_id" name="id">
  
        <div>
          <label for="first_name" class="block text-sm font-medium text-gray-700">Nome</label>
          <input type="text" id="first_name" name="first_name" required
                 value="{{ old('first_name', $client->first_name ?? '') }}"
                 class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div>
          <label for="phone_number" class="block text-sm font-medium text-gray-700">Telefone</label>
          <input type="text" id="phone_number" name="phone_number" required
                 value="{{ old('phone_number', $client->phone_number ?? '') }}"
                 class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required
                 value="{{ old('email', $client->email ?? '') }}"
                 class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div class="flex items-center space-x-2">
          <div class="w-full">
            <label for="document" class="block text-sm font-medium text-gray-700">Documento</label>
            <input type="text" id="document" name="document" required
                   value="{{ old('document', $client->document ?? '') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
          </div>
  
          <div class="w-2/5">
            <label for="documentType" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
            <select id="documentType" name="documentType" required
                    
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="cpf" {{ old('documentType', $client->documentType ?? '') === 'cpf' ? 'selected' : '' }}>CPF</option>
                    <option value="cnpj" {{ old('documentType', $client->documentType ?? '') === 'cnpj' ? 'selected' : '' }}>CNPJ</option>
            </select>
          </div>
        </div>
  
        <div class="flex justify-end space-x-2 pt-2 border-t mt-6">
          <button type="submit"
                  class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md transition">
            Salvar
          </button>
          <button type="button" onclick="closeModal('editClientModal')"
                  class="px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>