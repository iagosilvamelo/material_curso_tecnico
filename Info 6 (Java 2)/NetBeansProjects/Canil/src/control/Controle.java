package control;

import java.util.ArrayList;
import model.Cachorro;

public class Controle {
    private ArrayList <Cachorro> cachorros = new ArrayList();
    private int indice = 0;
    
    public void cadastrar(Cachorro c1){
        cachorros.add(c1);
    }
    
    public Cachorro exibir(){
        Cachorro c;
        
        try{
            c = cachorros.get(indice);
            
        }catch(Exception e){
            c = this.nulo();
        }
        
        return c;
    }
    
    public void editar(Cachorro c1){
        cachorros.get(indice).setDono(c1.getDono());
        cachorros.get(indice).setRaca(c1.getRaca());
        cachorros.get(indice).setIdade(c1.getIdade());
        cachorros.get(indice).setPeso(c1.getPeso());
    }
    
    public void excluir(){
        try{
            cachorros.remove(indice);
            
        }catch(Exception e){
            
        }
    }
    
    public void avanca_indice(){
        if (indice < (cachorros.size() -1)) indice++;
        else indice = cachorros.size() -1;
    }
    
    public void volta_indice(){
        if (indice > 0) indice--;
    }
    
    public Cachorro nulo(){
        return new Cachorro("", "", 0, 0);
    }
}
