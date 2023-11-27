import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class TareaService {
  constructor(private http: HttpClient) { }

  agregarTarea(tarea: any) {
    return this.http.post('http://localhost/miAppBackend/agregarTarea.php', tarea);
  }

  actualizarNombreTarea(id: number, nuevoNombre: string) {
    return this.http.post('http://localhost/miAppBackend/actualizarNombreTarea.php', {id, nuevoNombre});
  }

  eliminarTarea(id: number) {
    return this.http.post('http://localhost/miAppBackend/eliminarTarea.php', {id});
  }

  actualizarTarea(id: number, nuevoEstado: boolean) {
    return this.http.post('http://localhost/miAppBackend/actualizarTarea.php', {id, nuevoEstado});
  }

  obtenerTareas() {
    return this.http.get('http://localhost/miAppBackend/obtenerTareas.php');
  }
}