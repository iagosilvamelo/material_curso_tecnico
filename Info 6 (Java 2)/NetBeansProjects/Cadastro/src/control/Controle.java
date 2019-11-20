/*
    *   Estrutura TRY CACTH
    *   
    *   try{
    *       codigo a ser executado
    *   }
    *   cacth (Exception e){
    *       codigo a ser executado caso de erro (Exception)
    *   }
*/

/*
    Exercício 1
    Projeto igual a este com nome "Floricultura" que exiba:
    *   Tipo Flor
    *   Custo
    *   Venda
*/

package control;

import java.util.ArrayList;
import model.Pessoa;


public class Controle {
    private ArrayList <Pessoa> pessoas = new ArrayList();
    private int indice = 0;
    
    public void cadastrar(Pessoa p1){
        pessoas.add(p1);
    }
    
    public Pessoa exibir(){
        Pessoa p;
        
        try{
            p = pessoas.get(indice);
            
        }catch(Exception e){
            p = this.nulo();
        }
        
        return p;
    }
    
    public void editar(Pessoa p1){
        pessoas.get(indice).setNome(p1.getNome());
        pessoas.get(indice).setIdade(p1.getIdade());
        pessoas.get(indice).setCpf(p1.getCpf());
    }
    
    public void excluir(){
        try{
            pessoas.remove(indice);
            
        }catch(Exception e){
            
        }
    }
    
    public void avanca_indice(){
        if (indice < (pessoas.size() -1)) indice++;
        else indice = pessoas.size() -1;
    }
    
    public void volta_indice(){
        if (indice > 0) indice--;
    }
    
    public Pessoa nulo(){
        return new Pessoa("", 0, "");
    }
}