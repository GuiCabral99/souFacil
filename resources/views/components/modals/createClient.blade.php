<div id="createClientModal" 
     class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50"
     role="dialog" aria-modal="true" aria-labelledby="modalTitle">

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl relative">
        <div class="flex justify-between items-center border-b pb-3">
            <h2 id="modalTitle" class="text-2xl font-semibold text-gray-800">Cadastrar Novo Cliente</h2>
            <button onclick="closeModal('createClientModal')" 
                    class="text-gray-600 hover:text-gray-900 text-2xl leading-none font-bold">
                &times;
            </button>
        </div>

        <form method="POST" action="{{ route('clients.store') }}" class="space-y-4 mt-4" id="createClientForm">
            @csrf
        
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" name="first_name" id="first_name" required
                       value="{{ old('first_name') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('first_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <div>
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Telefone</label>
                <input type="text" name="phone_number" id="phone_number" required
                       value="{{ old('phone_number') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('phone_number')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       value="{{ old('email') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <div class="flex items-center gap-4">
                <div class="w-full">
                    <label for="document" class="block text-sm font-medium text-gray-700">Documento</label>
                    <input type="text" name="document" id="document" required
                           value="{{ old('document') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('document')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="w-2/5">
                    <label for="documentType" class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="documentType" id="documentType" required
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="cpf" {{ old('documentType') === 'cpf' ? 'selected' : '' }}>CPF</option>
                        <option value="cnpj" {{ old('documentType') === 'cnpj' ? 'selected' : '' }}>CNPJ</option>
                    </select>
                    @error('documentType')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        
            <div class="flex justify-end gap-2 pt-2 border-t mt-6">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                    Cadastrar
                </button>
                <button type="button" onclick="closeModal('createClientModal')"
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

        // Limpa campos ao fechar
        const form = modal.querySelector('form');
        if (form) form.reset();
    }

    function maskPhone(value) {
        return value
            .replace(/\D/g, '')
            .replace(/^(\d{2})(\d)/g, '($1) $2')
            .replace(/(\d{5})(\d{1,4})/, '$1-$2')
            .replace(/(-\d{4})\d+?$/, '$1');
    }

    function maskCPF(value) {
        return value
            .replace(/\D/g, '')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d)/, '$1.$2')
            .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    function maskCNPJ(value) {
        return value
            .replace(/\D/g, '')
            .replace(/^(\d{2})(\d)/, '$1.$2')
            .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
            .replace(/\.(\d{3})(\d)/, '.$1/$2')
            .replace(/(\d{4})(\d{1,2})$/, '$1-$2');
    }

    document.addEventListener("DOMContentLoaded", () => {
        const phoneInput = document.getElementById('phone_number');
        const documentInput = document.getElementById('document');
        const documentTypeSelect = document.getElementById('documentType');

        phoneInput.addEventListener('input', (e) => {
            e.target.value = maskPhone(e.target.value);
        });

        documentInput.addEventListener('input', (e) => {
            const type = documentTypeSelect.value;
            if (type === 'cpf') {
                e.target.value = maskCPF(e.target.value);
            } else {
                e.target.value = maskCNPJ(e.target.value);
            }
        });

        documentTypeSelect.addEventListener('change', () => {
            // Reaplica a máscara correta ao trocar de tipo
            const event = new Event('input', { bubbles: true });
            documentInput.dispatchEvent(event);
        });
    });
</script>
