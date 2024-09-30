<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Repositories\ClienteRepositoryInterface;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * - Intervention Image: A PHP image handling and manipulation library.
 *   - Facade: Provides a static interface to the Intervention Image library.
 *   - Driver: Specifies the GD driver for image processing.
 */
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Support\Facades\Storage; // Para manejar el almacenamiento de
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
        //return 'entro a index';

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


        // 2. Procesar la imagen si existe

        //verifica si foto_url existe
        if ($request->hasFile('foto_url')) {
            //manda print para validar que entra a la condicion
            print('entro a la condicion , foto_url');
            // llama a la funcion uploadImage
            $this->uploadImage($request, $cliente->id);
        }


         // Redirigir a la página de edición con un mensaje de éxito
         return redirect()->route('clientes.edit', $cliente->id)->with('success', 'Cliente creado exitosamente.');

        //return response()->json($cliente, 201);
    }

    public function edit($id)
    {
        $cliente= $this->clienteRepository->find($id);
        // return $clientes ;

        // Verifica si el cliente fue encontrado
        if (!$cliente) {
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado');
        }

        return view('clientes.edit', compact('cliente'));
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
        $validatedData = $request->except('foto_url');

         // Comprobar si la contraseña ha sido enviada. Si no lo ha sido, eliminamos 'pass' del array de datos validados.
        if (empty($validatedData['pass'])) {
            unset($validatedData['pass']);  // No actualizar la contraseña si no se proporciona
        } else {
            // En caso de que se haya proporcionado una nueva contraseña, la encriptamos antes de guardarla
            $validatedData['pass'] = bcrypt($validatedData['pass']);
        }


        // Actualizar cliente usando el repositorio
        $cliente = $this->clienteRepository->update($id, $validatedData);

        //verifica si foto_url existe
        if ($request->hasFile('foto_url')) {
            //manda print para validar que entra a la condicion
            print('entro a la condicion , foto_url');
            // llama a la funcion uploadImage
            $this->uploadImage($request, $id);
        }


        return redirect()->route('clientes.edit', $cliente->id)->with('message', 'Cliente actualizado exitosamente.');

    //    // return response()->json($cliente, 200);
    }

    // Eliminar un cliente específico de la base de datos
    public function destroy($id)
    {
        $this->clienteRepository->delete($id);
        //return response()->json(null, 204);
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }

    // Subir una imagen de perfil para un cliente específico
    public function uploadImage(Request $request, $id)
    {
        // Obtener el cliente
        $cliente = $this->clienteRepository->find($id);

        // Verificar si el cliente fue encontrado
        // if (!$cliente) {
        //     return response()->json(['message' => 'Cliente no encontrado'], 404);
        // }

        // Verificar si la imagen fue enviada
        if ($request->hasFile('foto_url')) {
            // Obtener la imagen del request
            $image = $request->file('foto_url');


            // Generar un nombre único para la imagen
            $filename = $id . '.' . $image->getClientOriginalExtension();

             // Ruta del directorio donde se almacenarán las imágenes
            $directory = 'uploads/clientes/';

            // Obtener todos los archivos actuales en el directorio
            $files = Storage::disk('public')->files($directory);

            // Buscar y eliminar solo los archivos que coincidan con el ID actual, sin importar la extensión
            foreach ($files as $file) {
                // Extraer solo el nombre base (sin extensión y sin ruta)
                $basename = pathinfo($file, PATHINFO_FILENAME);

                // Verificar si el archivo tiene el mismo ID y no es el archivo que se está subiendo
                if ($basename == (string)$id && $file !== $directory . $filename) {
                    // Si el archivo tiene el mismo ID pero diferente extensión, lo eliminamos
                    Storage::disk('public')->delete($file);
                }
            }

            // Subir la imagen a storage con Illuminate\Support\Facades\Storage
            $image->storeAs($directory , $filename, 'public');
            //$image->move(public_path('uploads/clientes'), $filename);

            // Redimensionar la imagen
            $imgManager = new ImageManager(new Driver());

            // leer imagen de la ruta storage con Illuminate\Support\Facades\Storage
             $thumbImage = $imgManager->read(Storage::disk('public')->path($directory  . $filename));


            // Leer la imagen de la ruta storage con Illuminate\Support\Facades\Storage

            $thumbImage = $imgManager->read(Storage::disk('public')->path($directory  . $filename));
           // $thumbImage = $imgManager->read(public_path('uploads/clientes/' . $filename));

            // Redimensionar la imagen a 200x200
           // $thumbImage->resize(200, 200);
            $thumbImage->cover(800, 800);

            // Guardar la imagen redimensionada en la ruta storage con Illuminate\Support\Facades\Storage
            $thumbImage->save(Storage::disk('public')->path($directory  . $filename));
            //$thumbImage->save(public_path('uploads/clientes/' . $filename));

            // Actualizar la URL de la imagen en la base de datos con  storage con Illuminate\Support\Facades\Storage
            $cliente->foto_url = Storage::disk('public')->path($directory  . $filename);
            //$cliente->foto_url = url('uploads/clientes/' . $filename);
           $cliente->foto_url = $directory  . $filename;
            $cliente->save();

            // borrar de  storage con Illuminate\Support\Facades\Storage todo los archivos con el mismo nombre, excepto el actual
            $files = Storage::disk('public')->files($directory );
            foreach ($files as $file) {
                if ($file != $directory  . $filename) {
                    Storage::disk('public')->delete($file);
                }
            }

            return redirect()->route('clientes.edit', $cliente->id)->with('success', 'Imagen de perfil actualizada exitosamente.');
        }


    }

}
