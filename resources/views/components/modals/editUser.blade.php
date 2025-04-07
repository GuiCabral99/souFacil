<div id="editUserModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl">
        <div class="flex justify-between items-center border-b pb-3">
            <h2 class="text-2xl font-semibold text-gray-800">Editar Conta</h2>
            <button onclick="closeModal('editUserModal')" class="text-gray-600 hover:text-gray-900 text-2xl leading-none font-bold">
                &times;
            </button>
        </div>
  
        <form method="POST" action="{{ route('user.update') }}" class="space-y-4 mt-4">
            @csrf
            @method('PUT')
  
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
  
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
  
            <div class="flex justify-end space-x-2 pt-2 border-t mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                    Salvar
                </button>
                <button type="button" onclick="closeModal('editUserModal')"
                        class="px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
  </div>
  