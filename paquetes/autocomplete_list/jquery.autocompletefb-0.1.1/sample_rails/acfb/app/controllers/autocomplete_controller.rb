class AutocompleteController < ApplicationController
 
  def index
    params[:id] =~ /(\w+)_(\w+)/
    render :text => $1.to_s.camelize.constantize.find(:all,:conditions => [$2+" like ?", params[:q]+'%']).collect {|x|x[$2]}.join("\n")
  end
end

