<div id="editUserModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
      <div class="flex justify-between items-center border-b pb-3">
        <h2 class="text-2xl font-semibold text-gray-800">Editar Usuário</h2>
        <button onclick="closeModal('editUserModal')" class="text-gray-600 hover:text-gray-900 text-2xl font-bold leading-none">
          &times;
        </button>
      </div>
  
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative mt-4">
          <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
  
      <form method="POST" id="editUserForm" class="space-y-4 mt-4">
        @csrf
        @method('PUT')
  
        <input type="hidden" name="id" id="edit_user_id">
  
        <div>
          <label for="edit_user_name" class="block text-sm font-medium text-gray-700">Nome</label>
          <input type="text" name="name" id="edit_user_name" required
                 class="w-full border border-gray-300 p-2 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div>
          <label for="edit_user_email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="edit_user_email" required
                 class="w-full border border-gray-300 p-2 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>
  
        <div>
          <label for="edit_user_password" class="block text-sm font-medium text-gray-700">Nova Senha (opcional)</label>
          <input type="password" name="password" id="edit_user_password"
                 class="w-full border border-gray-300 p-2 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500"
                 placeholder="Deixe em branco para manter a senha atual">
        </div>
  
        <div class="flex justify-end gap-2 pt-4 border-t mt-6">
          <button type="submit"
                  class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition">
            Salvar
          </button>
          <button type="button" onclick="closeModal('editUserModal')"
                  class="px-4 py-2 border border-gray-400 rounded text-gray-700 hover:bg-gray-100">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
  