<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepositoryInterface;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage; // Para manejar el almacenamiento de archivos


class ClienteController extends Controller
{
    protected $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {

        $this->clienteRepository = $clienteRepository;
    }

    // Mostrar una lista de todos los clientes
    public function index()
    {
        //return view('clientes.index');

        $clientes = $this->clienteRepository->getAll();
        //return response()->json($clientes);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    // Guardar un nuevo cliente en la base de datos
    public function store(StoreClienteRequest $request)
    {
        // 1. Validar los datos sin la imagen
        $validatedData = $request->except('foto_url'); // Excluir la imagen de la validación inicial

        // Añadir el ID del usuario autenticado y la fecha de registro
        $validatedData['idUsuario'] = Auth::id();
        $validatedData['fechaRegistro'] = now();


        // Crear el cliente en la base de datos
        $cliente = $this->clienteRepository->store($validatedData);


        // // 2. Procesar la imagen si existe
        // if ($request->hasFile('foto_url')) {
        //     $file = $request->file('foto_url');

        //     // Verificar si es una imagen válida
        //     if ($file->isValid() && in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'])) {

        //         // Si la imagen es mayor de 2 MB, la comprimimos
        //         if ($file->getSize() > 2097152) { // 2 MB en bytes
        //             try {
        //                 // Comprimir manualmente usando GD
        //                 $imageResource = $this->resizeImage($file->getRealPath());

        //                 // Generar un nombre único para la imagen
        //                 $filename = 'cliente_' . time() . '.' . $file->getClientOriginalExtension();
        //                 $filePath = 'uploads/clientes/' . $filename;

        //                 // Guardar la imagen comprimida
        //                 imagejpeg($imageResource, storage_path('app/public/upload/clientes' . $filePath), 75); // Comprimir al 75%

        //                 // Liberar recursos de la imagen
        //                 imagedestroy($imageResource);

        //                 // Añadir la ruta de la imagen a los datos validados
        //                 $validatedData['foto_url'] = $filePath;

        //             } catch (\Exception $e) {
        //                 return redirect()->back()->withErrors(['foto_url' => 'Error al procesar la imagen: ' . $e->getMessage()]);
        //             }
        //         } else {
        //             // Si la imagen es menor o igual a 2 MB, simplemente subirla sin procesar
        //             try {
        //                 $filename = 'cliente_' . time() . '.' . $file->getClientOriginalExtension();
        //                 $filePath = $file->storeAs('uploads/clientes', $filename, 'public');
        //                 $validatedData['foto_url'] = $filePath;

        //             } catch (\Exception $e) {
        //                 return redirect()->back()->withErrors(['foto_url' => 'Error al subir la imagen: ' . $e->getMessage()]);
        //             }
        //         }
        //     } else {
        //         return redirect()->back()->withErrors(['foto_url' => 'El archivo no es una imagen válida.']);
        //     }
        // }

        //  // Actualizar el cliente con la URL de la imagen si fue cargada
        //  $this->clienteRepository->update($cliente->id, ['foto_url' => $validatedData['foto_url'] ?? null]);

         // Redirigir a la página de edición con un mensaje de éxito
         return redirect()->route('clientes.edit', $cliente->id)->with('success', 'Cliente creado exitosamente.');

        //return response()->json($cliente, 201);
    }

    public function edit($id)
    {
        $cliente = $this->clienteRepository->find($id);
        return 'Prueba de edit'; //view('clientes.edit', compact('cliente'));
    }


    // Mostrar un cliente específico
    public function show($id)
    {
        $cliente = $this->clienteRepository->find($id);
        return 'prueba de show'; // view('clientes.show', compact('cliente'));
       // return response()->json($cliente);
    }

    // Actualizar un cliente existente en la base de datos
    public function update(UpdateClienteRequest $request, $id)
    {
        // Obtener los datos validados del Request
        $validatedData = $request->validated();

        // Actualizar cliente usando el repositorio
        $cliente = $this->clienteRepository->update($id, $validatedData);

        return response()->json($cliente, 200);
    }

    // Eliminar un cliente específico de la base de datos
    public function destroy($id)
    {
        $this->clienteRepository->delete($id);
        //return response()->json(null, 204);
        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado exitosamente.');
    }



     /**
     * Función para redimensionar la imagen usando GD.
     *
     * @param string $path Ruta del archivo de imagen.
     * @return GdImage|null Imagen redimensionada.
     */
    private function resizeImage($path)
    {
        // Crear la imagen desde el archivo
        $image = imagecreatefromjpeg($path);

        // Verificar si la imagen fue creada correctamente
        if (!$image) {
            return null; // Si no se puede crear, devuelve null
        }

        // Obtener dimensiones de la imagen
        $width = imagesx($image);
        $height = imagesy($image);

        // Definir el nuevo ancho, manteniendo la relación de aspecto
        $newWidth = 800;
        $newHeight = ($height / $width) * 800;

        // Crear una nueva imagen en blanco con el nuevo tamaño
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Redimensionar la imagen
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Devolver la imagen redimensionada
        return $newImage;
    }

}
