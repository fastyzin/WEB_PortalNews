import { useState, useEffect } from 'react';
import axios from 'axios';
import name from './login.jsx';

function PostList() {
  const [posts, setPosts] = useState([]);
  const [titulo, setTitulo] = useState('');
  const [desc, setDesc] = useState('');
  const nome = {name};

  useEffect(() => {
    mostrarUsuarios();
  }, []);

  const mostrarUsuarios = async () => {
    try {
      const response = await axios.get('http://localhost:8000/site/post/');
      setPosts(response.data);

    } catch (error) {
      console.error(error);
    }
  };

  const cadastrar = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:8000/site/post/', {
        titulo,
        desc,
        nome,
      });

      if (response.status === 201) {
        console.log('Cadastro realizado com sucesso!');
        mostrarUsuarios(); 
      } } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h2>Cadastrar Post</h2>
      <form onSubmit={cadastrar}>
        <div>
          <label>Titulo:</label><br></br>
          <input
            type="text"
            value={titulo}
            onChange={(e) => setTitulo(e.target.value)}
          />
        </div><br></br>
        <div>
          <label>Descricao:</label><br></br>
          <input
            type="text"
            value={desc}
            onChange={(e) => setDesc(e.target.value)}
          />
        </div>
        <br></br>
        <button type="submit">Cadastrar</button>
      </form>

      <h2>Lista de Posts</h2>
      <table>
        <thead>
          <tr>
            
            <th>Titulo</th>
            <th>Descricao</th>
            <th>Nome</th>
          </tr>
        </thead> 
        <tbody>
          {posts.map((post) => (
            <tr key={post.id}>
              <td>{post.id}</td>
              <td>{post.titulo}</td>
              <td>{post.desc}</td>
              <td>{post.nome}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

export default PostList;