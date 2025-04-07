<div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Editar Usuário</h2>
            <button onclick="closeModal('editUserModal')" class="text-2xl text-gray-600 hover:text-gray-900 font-bold leading-none">
                &times;
            </button>
        </div>
  
        <form method="POST" id="editUserForm" class="space-y-4">
            @csrf
            @method('PUT')
  
            <div>
                <label for="edit_first_name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="first_name" id="edit_first_name" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
  
            <div>
                <label for="edit_email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="edit_email" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
  
            <div>
                <label for="edit_role" class="block text-sm font-medium text-gray-700">Tipo</label>
                <select name="role" id="edit_role" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="admin">Admin</option>
                    <option value="user">Usuário</option>
                </select>
            </div>
  
            <div class="flex justify-end space-x-2 pt-2 border-t mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                    Salvar
                </button>
                <button type="button" onclick="closeModal('editUserModal')" class="px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
  