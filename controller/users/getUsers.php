<?php
    include '../model/User.php';
    include '../model/Role.php';

    function showUsers(){
        $user = new User;
        $users = $user->getAllUsers();
        $usersHtml='';        
        if(!empty($users)){
            while($row=$users->fetch_array()){
                $usersHtml.="
                <tr>
                    <th scope='row'>".$row['usr_id']."</th>
                    <td>".$row['usr_nombre_completo']."</td>
                    <td>".$row['usr_contacto']."</td>
                    <td>".$row['usr_correo']."</td>
                    <td>".$row['usr_direccion']."</td>
                    <td>".$row['usr_usuario']."</td>
                    <td>".$row['rol_nombre']."</td>
                    <td>
                        <button class='btn btn-info openEditModal' data-bs-toggle='modal' data-bs-target='#editUserModal' role='button' type='submit' id='usr_idEdit' name='usr_idEdit' data-id='".$row['usr_id']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                        </button>
                    </td>
                    <td>
                        <button class='btn btn-danger openDeleteModal' data-bs-toggle='modal' data-bs-target='#delUserModal' role='button' id='usr_idDel' name='usr_idDel' data-id='".$row['usr_id']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                            <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                            <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                            </svg>
                        </button>
                    </td>
                </tr>";
            }
        }else{
            $usersHtml.="<tr><th style='color:red';>¡No hay nada que mostrar!</th></tr>";
        }
        return $usersHtml;
    }

    function showRoles(){
        $role = new Role;
        $roles = $role->getAllRoles();
        $rolesHtml='';        
        if(!empty($roles)){
            while($row=$roles->fetch_array()){
                $rolesHtml.="
                    <option value='".$row['rol_id']."'>".$row['rol_nombre']."</option>";
            }
        }else{
            $rolesHtml.="<option style='color:red';>¡No hay nada que mostrar!</option>";
        }
        return $rolesHtml;
    }

?>