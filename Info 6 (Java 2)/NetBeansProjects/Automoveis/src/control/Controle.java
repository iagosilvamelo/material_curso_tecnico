package control;

import java.util.ArrayList;
import model.Carro;

public class Controle {
    private ArrayList <Carro> carros = new ArrayList();
    private int indice = 0;
    
    public void cadastrar(Carro c1){
        carros.add(c1);
    }
    
    public Carro exibir(){
        Carro c;
        
        try{
            c = carros.get(indice);
            
        }catch(Exception e){
            c = this.nulo();
        }
        
        return c;
    }
    
    public void editar(Carro c1){
        carros.get(indice).setMarca(c1.getMarca());
        carros.get(indice).setModelo(c1.getModelo());
        carros.get(indice).setAno(c1.getAno());
        carros.get(indice).setQuantidade(c1.getQuantidade());
    }
    
    public void excluir(){
        try{
            carros.remove(indice);
            
        }catch(Exception e){
            
        }
    }
    
    public void avanca_indice(){
        if (indice < (carros.size() -1)) indice++;
        else indice = carros.size() -1;
    }
    
    public void volta_indice(){
        if (indice > 0) indice--;
    }
    
    public Carro nulo(){
        return new Carro("", "", 0, 0);
    }
}
