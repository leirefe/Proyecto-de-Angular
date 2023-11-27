import { Component } from '@angular/core';
import { Tarea } from '../../models/Tarea';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { HttpClientModule } from '@angular/common/http'; 

@Component({
  selector: 'app-tareas',
  standalone: true,
  templateUrl: './tareas.component.html',
  styleUrls: ['./tareas.component.css'],
  imports: [CommonModule, FormsModule, HttpClientModule]
})
export class TareasComponent {
  listaTareas: Tarea[] = []
  nombreTarea= '';

  constructor(private http: HttpClient) {}
  ngOnInit() {
    this.http.get('http://localhost/miAppBackend/obtenerTareas.php').subscribe((res: any) => {
      this.listaTareas = res.map((tarea: any) => {
        return {
          id: tarea.id,
          nombre: tarea.nombre,
          estado: Boolean(Number(tarea.estado))
        };
      });
    }, (error: any) => {
      console.error(error);
    });
  }
  agregarTarea() {
  if (!this.nombreTarea) {
    console.error('nombreTarea no está definido');
    return;
  }

  const tarea: Tarea = {
    nombre: this.nombreTarea,
    estado: false
  }

  this.http.post<any>('http://localhost/miAppBackend/agregarTarea.php', tarea).subscribe((res: any) => {
    // Asegúrate de que la nueva tarea tenga el id que se generó en la base de datos
    if (res && res.id) {
      tarea.id = res.id;
      this.listaTareas.push(tarea);
    } else {
      console.error('No se devolvió un id válido desde el backend');
    }
    this.nombreTarea = '';
  }, (error: any) => {
    console.error(error);
  });
}

  eliminarTarea(tarea: Tarea) {
    this.http.post('http://localhost/miAppBackend/eliminarTarea.php', {id: tarea.id}).subscribe((res: any) => {
      console.log(res);
      this.listaTareas = this.listaTareas.filter(t => t.id !== tarea.id);
    }, (error: any) => {
      console.error(error);
    });
  }
  
  actualizarTarea(index: number, tarea: Tarea) {
    this.http.post('http://localhost/miAppBackend/actualizarTarea.php', {id: tarea.id}).subscribe((res: any) => {
      console.log(res);
      tarea.estado = !tarea.estado;
      this.listaTareas[index] = tarea;
    }, (error: any) => {
      console.error(error);
    });
  }
  } // Add the closing brace for the TareasComponent class

/* 

ngOnInit(): 
Este método se llama automáticamente cuando se inicializa el componente. 
Aquí se hace una solicitud GET al endpoint obtenerTareas.php para obtener la lista de tareas desde el servidor backend.
La respuesta se mapea a un array de tareas y se asigna a this.listaTareas.


agregarTarea(): 
Este método se utiliza para agregar una nueva tarea.
Primero, verifica que this.nombreTarea esté definido.
Luego, crea un objeto tarea y hace una solicitud POST al endpoint agregarTarea.php para agregar la tarea al servidor backend.
Si la respuesta contiene un id válido, se añade la tarea a this.listaTareas.


eliminarTarea(tarea: Tarea): 
Este método se utiliza para eliminar una tarea.
Hace una solicitud POST al endpoint eliminarTarea.php con el id de la tarea a eliminar.
Si la solicitud es exitosa, se elimina la tarea de this.listaTareas.


actualizarTarea(index: number, tarea: Tarea):
Este método se utiliza para actualizar el estado de una tarea.
Hace una solicitud POST al endpoint actualizarTarea.php con el id de la tarea a actualizar. 
Si la solicitud es exitosa, se actualiza el estado de la tarea en this.listaTareas */
