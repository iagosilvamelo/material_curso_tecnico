package control;

import java.util.ArrayList;
import model.Flor;

public class Controle {
    private ArrayList <Flor> flores = new ArrayList();
    private int indice = 0;
    
    public void cadastrar(Flor f1){
        flores.add(f1);
    }
    
    public Flor exibir(){
        Flor f;
        
        try{
            f = flores.get(indice);
            
        }catch(Exception e){
            f = this.nulo();
        }
        
        return f;
    }
    
    public void editar(Flor f1){
        flores.get(indice).setFlor(f1.getFlor());
        flores.get(indice).setTipoFlor(f1.getTipoFlor());
        flores.get(indice).setValor(f1.getValor());
    }
    
    public void excluir(){
        try{
            flores.remove(indice);
            
        }catch(Exception e){
            
        }
    }
    
    public void avanca_indice(){
        if (indice < (flores.size() -1)) indice++;
        else indice = flores.size() -1;
    }
    
    public void volta_indice(){
        if (indice > 0) indice--;
    }
    
    public Flor nulo(){
        return new Flor("", "", 0);
    }
}
